<?php

namespace App\Http\Controllers;

use App\Models\brandModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class brandController extends Controller
{
    public function getView(){
        return view('admin.brand.brand_home');
    }

    public function getDataTable(Request $request){
        $brands = brandModel::all()->sortBy('slug');
        return datatables()->of($brands)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $data = brandModel::find($row->id)->toArray();
                $list = ['id','name','slug'];
                $json_data = (new ToolsModel())->getJson($data,$list);

                $html = '<div class="btn btn-outline-secondary btn-sm btnEdit" data = \''.$json_data.'\'><i class="fa-solid fa-pencil"></i> Cập nhật </div>';
                $html .= '<div class="btn btn-outline-danger btn-sm btnDelete ml-2" data="'.$row->id.'"><i class="fa-solid fa-trash"></i> Xóa </div>';
                return $html;
            })->toJson();

    }

    public function addBrand(Request $request){
        try {
            $brands = new brandModel;
            $brands->name = $request->name;
            $brands->slug = $request->slug;
            $brands->save();
            return ToolsModel::status('Thương hiệu đã được thêm!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }
    }

    public function updateBrand(Request $request){
        try {
            $brands = brandModel::find($request->id);
            $brands->name = $request->name;
            $brands->slug = $request->slug;
            $brands->save();
            return ToolsModel::status('Thương hiệu đã được cập nhật!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }
    }

    public function deleteBrand(Request $request){
        try {
            $brands = brandModel::find($request->id);
            $brands->delete();
            return ToolsModel::status('Thương hiệu đã được xóa!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }
    }
}
