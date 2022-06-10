<?php

namespace App\Http\Controllers;

use App\Events\notification;
use App\Events\notificationBill;
use App\Models\billModel;
use App\Models\brandModel;
use App\Models\orderModel;
use App\Models\ToolsModel;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class billController extends Controller
{
    public function getView()
    {
        if (isset($_GET['vnp_TxnRef'])) {
            $bill_code = $_GET['vnp_TxnRef'];
            $bill = billModel::where('code', $bill_code)->first();

            $bill->payment = Carbon::now();
            $bill->save();

            if (Auth::user()->id != $bill->user->id) abort(404);
            $total = 0;
            foreach ($bill->order as $order) {
                $total += $order->quantity * $order->product->price;
            }
            $ship = 0;
            if ($total <= 700000) $ship = 30000;
            return view('guest.transaction.transaction_bill', ['bill' => $bill, 'total' => $total, 'ship' => $ship]);
        }

        return abort(404);
    }

    public function getViewBill($id){
        $bill = billModel::find($id);
        if (Auth::user()->id != $bill->user->id) abort(404);

        $total = 0;
        foreach ($bill->order as $order) {
            $total += $order->quantity * $order->product->price;
        }
        $ship = 0;
        if ($total <= 700000) $ship = 30000;
        return view('guest.transaction.transaction_bill', ['bill' => $bill, 'total' => $total, 'ship' => $ship]);
    }

    public function getViewPDF($bill_id)
    {
        $bill = billModel::find($bill_id);
        if (Auth::user()->id != $bill->user->id) abort(404);

        $total = 0;
        foreach ($bill->order as $order) {
            $total += $order->quantity * $order->product->price;
        }

        $ship = 0;
        if ($total <= 700000) $ship = 30000;

        return view('xml.exportPDF', ['bill' => $bill, 'total' => $total, 'ship' => $ship]);
    }

    public function addBill(Request $request)
    {
        try {
            $bill = new billModel();
            $bill->name = $request->name;
            $bill->address = $request->address;
            $bill->phone_number = $request->phone_number;
            $bill->description = $request->description;
            $bill->type = $request->radioTran;
            $bill->code = time() . Auth::user()->id;
            $bill->user_id = Auth::user()->id;
            $bill->read = 0;
            $bill->save();

            broadcast(new notification('order','1'));

            $products = json_decode($request->products);
            foreach ($products as $product) {
                $order = new orderModel();
                $order->bill_id = $bill->id;

                $product = json_decode($product);

                if ($product->quantity > 0) {

                    $order->product_id = $product->product_id;
                    $order->quantity = $product->quantity;
                    $order->save();
                }
            }

            $total = 0;
            foreach ($bill->order as $order) {
                $total += $order->quantity * $order->product->price;
            }

            $ship = 0;
            if ($total <= 700000) $ship = 30000;

            if ($bill->type == 0) {
                return view('guest.transaction.transaction_bill', ['bill' => $bill, 'total' => $total, 'ship' => $ship]);
            }

            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://mymine.local/hoa-don-thanh-toan";
            $vnp_TmnCode = "B8H7M5Z6";//Mã website tại VNPAY
            $vnp_HashSecret = "SPPWTLAJVSZOBOZGOLJNTHYCNBZNQNPA"; //Chuỗi bí mật

            $vnp_TxnRef = $bill->code; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán Test';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = (($total - $total * 5 / 100) + $ship) * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

//var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
//            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
//            } else {
//                echo json_encode($returnData);
//            }
        }catch (\Exception $exception){
            return abort(404);
        }

    }

    public function getCountBill(){
        return billModel::where('read',0)->count();
    }


    public function getDataTable(Request $request){
        $histories = User::find(Auth::user()->id)->bill->sortByDesc('created_at');
        return datatables()->of($histories)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $html = '<div class="btn btn-outline-secondary btn-sm btnDetailHis" data = \''.$row->id.'\'><i class="fa-solid fa-eye"></i> Xem chi tiết </div>';
                return $html;
            })->addColumn('created_at', function ($row) {
                $html = $row->created_at->format('d-m-Y');
                return $html;
            })->toJson();

    }

    public function getViewAdmin(){
        return view('admin.transaction.transaction_home');
    }

    public function getDataTableAdmin(Request $request){
        $histories = billModel::all()->sortByDesc('created_at');
        return datatables()->of($histories)
            ->addIndexColumn()
            ->addColumn('code', function ($row) {
                if ($row->read == 0){
                    $html = $row->code . '<small class="badge badge-danger ml-2"><i class="far fa-clock"></i> new </small>';
                }else {
                    $html = $row->code;
                }
                return $html;
            })->addColumn('action', function ($row) {
                $html = '<div class="btn btn-outline-primary btn-sm mr-2 btnUpdateHis" data = \''.$row.'\'><i class="fa-solid fa-pen-to-square"></i> Cập nhật </div>';
                $html .= '<div class="btn btn-outline-secondary btn-sm btnDetailHis" data = \''.$row->id.'\'><i class="fa-solid fa-eye"></i> Xem chi tiết </div>';
                return $html;
            })->addColumn('created_at', function ($row) {
                $html = $row->created_at->format('d-m-Y');
                return $html;
            })->addColumn('payment', function ($row) {
                $html = '';
                if ($row->type == 1 || ($row->type == 0 && $row->payment) ){
                        $html = '<div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="customCheckbox2" checked="" disabled="">
                        <label for="customCheckbox2" class="custom-control-label"></label>
                        </div>';
                } else{
                    $html = '<div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="customCheckbox2" disabled="">
                        <label for="customCheckbox2" class="custom-control-label"></label>
                        </div>';
                }
                return $html;
            })->rawColumns(['code', 'action', 'created_at', 'payment'])->toJson();

    }


    public function getBillAdmin($id){
        $bill = billModel::find($id);
        $bill->read = 1;
        $bill->save();

        $total = 0;
        foreach ($bill->order as $order) {
            $total += $order->quantity * $order->product->price;
        }
        $ship = 0;
        if ($total <= 700000) $ship = 30000;
        return view('admin.transaction.transaction_detail', ['bill' => $bill, 'total' => $total, 'ship' => $ship]);
    }

    public function updateBill(Request $request){
        try {
            $bill = billModel::find($request->id);
            if ($request->payment == 1){
                $bill->payment = Carbon::now();
            }else{
                $bill->payment = null;
            }
            $bill->save();

            return ToolsModel::status('Đơn hàng đã được cập nhật!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }



    }
}
