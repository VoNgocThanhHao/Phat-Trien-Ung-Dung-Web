<?php

namespace App\Http\Controllers;

use App\Models\brandModel;
use App\Models\productModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\String_;

class categoryController extends Controller
{
    public function getView($slug){
        $cate = '';
        switch ($slug){
            case 'dien-thoai':
                $cate = 'ĐIỆN THOẠI';
                $products = productModel::where('category','Điện thoại')->get();
                break;
            case 'laptop':
                $cate = 'LAPTOP';
                $products = productModel::where('category','Laptop')->get();
                break;
            case 'may-tinh-ban':
                $cate = 'MÁY TÍNH BÀN (PC)';
                $products = productModel::where('category','Máy tính bàn (PC)')->get();
                break;
            case 'dong-ho-thong-minh':
                $cate = 'ĐỒNG HỒ THÔNG MINH';
                $products = productModel::where('category','Đồng hồ thông minh')->get();
                break;
            case 'may-tinh-bang':
                $cate = 'MÁY TÍNH BẢNG';
                $products = productModel::where('category','Máy tính bảng')->get();
                break;
            case 'phu-kien':
                $cate = 'PHỤ KIỆN';
                $products = productModel::where('category','Phụ kiện')->get();
                break;
            default:
                $products = [];
        }
        return view('admin.product.product_filter_category', ['cate'=>$cate, 'products'=>$products]);
    }


    public function getViewGuest($slug){
        $cate = '';
        $brands = brandModel::all();

//        $arr = [];
//        $products = productModel::whereIn('brand_id', $arr)->get()->toArray();
//        dd($products);

        switch ($slug){
            case 'dien-thoai':
                $cate = 'ĐIỆN THOẠI';
                $products = productModel::where('category','Điện thoại')->get();
                break;
            case 'laptop':
                $cate = 'LAPTOP';
                $products = productModel::where('category','Laptop')->get();
                break;
            case 'may-tinh-ban':
                $cate = 'MÁY TÍNH BÀN (PC)';
                $products = productModel::where('category','Máy tính bàn (PC)')->get();
                break;
            case 'dong-ho-thong-minh':
                $cate = 'ĐỒNG HỒ THÔNG MINH';
                $products = productModel::where('category','Đồng hồ thông minh')->get();
                break;
            case 'may-tinh-bang':
                $cate = 'MÁY TÍNH BẢNG';
                $products = productModel::where('category','Máy tính bảng')->get();
                break;
            case 'phu-kien':
                $cate = 'PHỤ KIỆN';
                $products = productModel::where('category','Phụ kiện')->get();
                break;
            default:
                $products = [];
        }

        return view('guest.product.product_filter',
            [
                'slug'=>$slug,
                'products'=>$products,
                'brands'=>$brands,
            ]);
    }

}
