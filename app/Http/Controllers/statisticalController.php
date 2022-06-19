<?php

namespace App\Http\Controllers;

use App\Models\billModel;
use App\Models\orderModel;
use App\Models\productModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class statisticalController extends Controller
{
    public function getView(){
        // 'Điện thoại', 'Laptop', 'Máy tính bàn (PC)', 'Đồng hồ thông minh', 'Máy tính bảng', 'Phụ kiện'
        $income = [0,0,0,0,0,0];

        $orders = orderModel::all();

        // Tổng doang thu
        foreach ($orders as $order){
//            dd($order->bill->created_at->month);
            if ($order->bill->payment){
                if ($order->product->category == 'Điện thoại'){
                    $income[0] += $order->quantity * $order->product->price;
                }else if ($order->product->category == 'Laptop'){
                    $income[1] += $order->quantity * $order->product->price;
                }else if ($order->product->category == 'Máy tính bàn (PC)'){
                    $income[2] += $order->quantity * $order->product->price;
                }else if ($order->product->category == 'Đồng hồ thông minh'){
                    $income[3] += $order->quantity * $order->product->price;
                }else if ($order->product->category == 'Máy tính bảng'){
                    $income[4] += $order->quantity * $order->product->price;
                }else if ($order->product->category == 'Phụ kiện'){
                    $income[5] += $order->quantity * $order->product->price;
                }
            }
        }


    // So sanh
        $year_1 = Carbon::now()->year;
        $result_year_1 = [0,0,0,0,0,0,0,0,0,0,0,0];
        $year_2 = $year_1 - 1;
        $result_year_2 = [0,0,0,0,0,0,0,0,0,0,0,0];

        $orders = orderModel::all();
        foreach ($orders as $order){
            if ($order->bill->payment){
                if ($order->bill->created_at->year == $year_1){
                    $result_year_1[$order->bill->created_at->month -1] += $order->quantity * $order->product->price;
                } else if ($order->bill->created_at->year == $year_2){
                    $result_year_2[$order->bill->created_at->month -1] += $order->quantity * $order->product->price;
                }
            }
        }


//        Sản phẩm
        $array_sanpham = [];
        foreach ($orders as $order){
            if ($order->bill->payment){
                if ($order->product->category == "Điện thoại"){
                    if (array_key_exists($order->product->name,$array_sanpham)) {
                        $array_sanpham[$order->product->name] += $order->quantity * $order->product->price;
                    }else{
                        $array_sanpham[$order->product->name] = $order->quantity * $order->product->price;
                    }
                }
            }
        }



//        Lượt xem
        $array_luotxem = [0,0,0,0,0,0];
        $products = productModel::all();
        foreach ($products as $product){
            if ($product->category == 'Điện thoại'){
                $array_luotxem[0] += $product->view;
            }else if ($product->category == 'Laptop'){
                $array_luotxem[1] += $product->view;
            }else if ($product->category == 'Máy tính bàn (PC)'){
                $array_luotxem[2] += $product->view;
            }else if ($product->category == 'Đồng hồ thông minh'){
                $array_luotxem[3] += $product->view;
            }else if ($product->category == 'Máy tính bảng'){
                $array_luotxem[4] += $product->view;
            }else if ($product->category == 'Phụ kiện'){
                $array_luotxem[5] += $product->view;
            }
        }


        return view('admin.statistical.statistical_home',
            [
                'income'=>$income,
                'result_year_1'=>$result_year_1,
                'result_year_2'=>$result_year_2,
                'array_sanpham'=>$array_sanpham,
                'array_luotxem'=>$array_luotxem,
            ]);
    }

    public function getSoSanh(Request $request){
        $year = $request->year;
        $result_year = [0,0,0,0,0,0,0,0,0,0,0,0];

        $orders = orderModel::all();
        foreach ($orders as $order){
            if ($order->bill->payment){
                if ($order->bill->created_at->year == $year){
                    $result_year[$order->bill->created_at->month -1] += $order->quantity * $order->product->price;
                }
            }
        }

        return $result_year;
    }

    public function getSanPham(Request $request){
        $category = $request->category;

        $result = array();

        $orders = orderModel::all();

        // Tổng doang thu
        foreach ($orders as $order){
            if ($order->bill->payment){
                if ($order->product->category == $category){
                    if (array_key_exists($order->product->name,$result)) {
                        $result[$order->product->name] += $order->quantity * $order->product->price;
                    }else{
                        $result[$order->product->name] = $order->quantity * $order->product->price;
                    }
                }
            }
        }

        return $result;
    }
}
