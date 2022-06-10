<?php

namespace App\Http\Controllers;

use App\Models\favouriteModel;
use App\Models\ToolsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class favouriteController extends Controller
{
    public function getList(){
        try {
            $list = User::find(Auth::user()->id)->favourite;
            return view('xml.listFavourite', ['list'=>$list]);
        }catch (\Exception $exception){
            return '<h2>Máy chủ đang bị gián đoạn, xin vui lòng thử lại sau!</h2>';
        }
    }

    public function getCount(){
        try {
            $list = User::find(Auth::user()->id)->favourite;
            return count($list);
        }catch (\Exception $exception){
            return 0;
        }
    }

    public function addFavourite(Request $request){
        try {
            $favourites = User::find(Auth::user()->id)->favourite;
            foreach ($favourites as $favourite){
                if ($favourite->product_id == $request->product_id) return ToolsModel::status('Sản phẩm đã có trong danh sách yêu thích!', 500);
            }
            $favourite = new favouriteModel();
            $favourite->user_id = Auth::user()->id;
            $favourite->product_id = $request->product_id;
            $favourite->save();
            return ToolsModel::status('Sản phẩm đã được thêm vào danh sách yêu thích!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }

    }

    public function deleteFavourite(Request $request){
        try {
            if (Auth::user()->id != $request->id) return ToolsModel::status('Máy chủ không phản hồi!', 500);
            $favourite = favouriteModel::find($request->fav_id);
            $favourite->delete();
            return ToolsModel::status('Xóa thành công!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }

    }
}
