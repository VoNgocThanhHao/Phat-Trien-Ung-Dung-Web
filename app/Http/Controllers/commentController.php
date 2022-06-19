<?php

namespace App\Http\Controllers;

use App\Events\commentProduct;
use App\Events\messageSent;
use App\Models\brandModel;
use App\Models\commentModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class commentController extends Controller
{
    public function getView(){
        return view('admin.comment.comment_home');
    }

    public function getDataTable(Request $request){
        $comment = commentModel::all()->sortByDesc('created_at');

        return datatables()->of($comment)
            ->addIndexColumn()
            ->addColumn('user_id', function ($row) {
                $user = commentModel::find($row->id)->user;
                return $user->name;
            })
            ->addColumn('product_id', function ($row) {
                $product = commentModel::find($row->id)->product;
                return $product->name;
            })
            ->addColumn('created_at', function ($row) {
                $time = $row->created_at->format('d-m-Y');
                return $time;
            })
            ->addColumn('action', function ($row) {
                return '<div class="btn btn-outline-danger btn-sm btnDelete ml-2" data="' . $row->id . '"><i class="fa-solid fa-trash"></i> Xóa </div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function deleteComment(Request $request){
        try {
            $comment = commentModel::find($request->id);
            $comment->delete();
            return ToolsModel::status('Bình luận đã được xóa!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }
    }

    public function sentComment(Request $request){
        $comment = new commentModel();
        $comment->content = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->product_id = $request->product_id;
        $comment->save();

        broadcast(new commentProduct($request->product_id));
    }
}
