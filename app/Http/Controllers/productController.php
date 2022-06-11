<?php

namespace App\Http\Controllers;

use File;
use App\Models\brandModel;
use App\Models\productModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ImageResize;
use App\Image;

class productController extends Controller
{
    public function getView(){
        return view('admin.product.product_home');
    }

    public function getViewAdd(){
        $brands = brandModel::all();
        return view('admin.product.product_add',['type'=>'add', 'brands'=>$brands]);
    }

    public function getViewUpdate($id_product){
        $product = productModel::find($id_product);
        $brands = brandModel::all();
        return view('admin.product.product_add',['type'=>'update', 'product'=>$product, 'brands'=>$brands]);
    }

    public function getDataTable(Request $request){

        $products = productModel::all()->sortBy('name');
        return datatables()->of($products)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $html = '<div class="btn btn-outline-secondary btn-sm btnEdit" data="'.$row->id.'"><i class="fa-solid fa-pencil"></i> Cập nhật </div>';
                $html .= '<div class="btn btn-outline-danger btn-sm btnDelete ml-2" data="'.$row->id.'"><i class="fa-solid fa-trash"></i> Xóa </div>';
                return $html;
            })->addColumn('price', function ($row) {
                return number_format($row->price, 0 ,"," ,".");
            })
            ->rawColumns(['action', 'name', 'price',])
            ->toJson();
    }

    public function getSlug($slug){
        return $slug;
    }

    public function addProduct(Request $request){

//        try {
            $product = new productModel;

            $product->name = $request->name;
            $product->category = $request->category;

            $path_description = 'public/mySource/descriptions/'.time().'_description.txt';
            \File::put($path_description, $request->description);
            $product->description = $path_description;

            $path_specification = 'public/mySource/specifications/'.time().'_specification.txt';
            \File::put($path_specification, $request->specification);
            $product->specification = $path_specification;

            $product->price = str_replace(".","",$request->price);
            $product->discount = $request->discount;
            $product->view = 0;
            $product->status = $request->status;
            $product->brand_id = $request->brand;
            $product->ram = $request->ram;
            $product->chip = $request->chip;

            if ($request->image != null) {
                $image_array_1 = explode(";", $request->image);
                $image_array_2 = explode(",", $image_array_1[1]);
                $data = base64_decode($image_array_2[1]);
                $imageName = time() . '.png';
                file_put_contents(public_path('mySource/imgs/products/'.$imageName), $data);
                $product->image = 'public/mySource/imgs/products/'.$imageName;
            }


            // --------- [ Resize Image ] ---------------
            $img = ImageResize::make($product->image);
            if ($img->width() > $img->height()){
                $width = $img->width();
                $height = $img->width();
            }else{
                $width = $img->height();
                $height = $img->height();
            }

            $square = ImageResize::canvas($width, $height, '#fff')->insert($img, 'center');
            $square->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($product->image);


            $image_list = 'public/mySource/imgs/products/'.time().'/';
            \File::makeDirectory($image_list, 0777, true, true);
            $i = 0 ;
            if ($request->hasFile('images')){
                foreach ($request->images as $image){
                    $ext = $image->extension();
                    $image_name = time().'_'.$i.'.'.$ext;
                    $image->move($image_list,$image_name);

                    // --------- [ Resize Image ] ---------------
                    $img_sub = ImageResize::make($image_list.$image_name);

                    if ($img_sub->width() > $img_sub->height()){
                        $width = $img_sub->width();
                        $height = $img_sub->width();
                    }else{
                        $width = $img_sub->height();
                        $height = $img_sub->height();
                    }

                    $square_sub = ImageResize::canvas($width, $height, '#fff')->insert($img_sub, 'center');
                    $square_sub->resize(400, 400, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($image_list.$image_name);
                    // ------------------------------------------

                    $i++;
                }
            }

            $product->images_list = $image_list;

            $product->save();

//            return ToolsModel::status('Sản phẩm đã được thêm!', 200);
//        }catch (\Exception $exception){
//            return ToolsModel::status('Máy chủ không phản hồi!', 500);
//        }

    }

    public function updateProduct(Request $request){
        try {
            $product = productModel::find($request->id);

            $product->name = $request->name;
            $product->category = $request->category;

            File::delete($product->description);
            $path_description = 'public/mySource/descriptions/'.time().'_description.txt';
            \File::put($path_description, $request->description);
            $product->description = $path_description;

            File::delete($product->specification);
            $path_specification = 'public/mySource/specifications/'.time().'_specification.txt';
            \File::put($path_specification, $request->specification);
            $product->specification = $path_specification;

            $product->price = str_replace(".","",$request->price);
            $product->discount = $request->discount;
            $product->status = $request->status;
            $product->brand_id = $request->brand;
            $product->ram = $request->ram;
            $product->chip = $request->chip;

            if ($request->image != null) {
                File::delete($product->image);

                $image_array_1 = explode(";", $request->image);
                $image_array_2 = explode(",", $image_array_1[1]);
                $data = base64_decode($image_array_2[1]);
                $imageName = time() . '.png';
                file_put_contents(public_path('mySource/imgs/products/'.$imageName), $data);
                $product->image = 'public/mySource/imgs/products/'.$imageName;


                // --------- [ Resize Image ] ---------------
                $img = ImageResize::make($product->image);
                if ($img->width() > $img->height()){
                    $width = $img->width();
                    $height = $img->width();
                }else{
                    $width = $img->height();
                    $height = $img->height();
                }

                $square = ImageResize::canvas($width, $height, '#fff')->insert($img, 'center');
                $square->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($product->image);
            }


            $image_list = 'public/mySource/imgs/products/'.time().'/';
            $i = 0 ;
            if ($request->hasFile('images')){
                \File::makeDirectory($image_list, 0777, true, true);
                \File::deleteDirectory($product->images_list);

                foreach ($request->images as $image){
                    $ext = $image->extension();
                    $image_name = time().'_'.$i.'.'.$ext;
                    $image->move($image_list,$image_name);

                    // --------- [ Resize Image ] ---------------
                    $img_sub = ImageResize::make($image_list.$image_name);

                    if ($img_sub->width() > $img_sub->height()){
                        $width = $img_sub->width();
                        $height = $img_sub->width();
                    }else{
                        $width = $img_sub->height();
                        $height = $img_sub->height();
                    }

                    $square_sub = ImageResize::canvas($width, $height, '#fff')->insert($img_sub, 'center');
                    $square_sub->resize(400, 400, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($image_list.$image_name);
                    // ------------------------------------------

                    $i++;
                }
                $product->images_list = $image_list;
            }


            $product->save();

            return ToolsModel::status('Sản phẩm đã được cập nhật!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }
    }

    public function deleteProduct(Request $request){
        try {
            $product = productModel::find($request->id);
            File::delete($product->description);
            File::delete($product->specification);
            \File::deleteDirectory($product->images_list);
            File::delete($product->image);
            $product->delete();
            return ToolsModel::status('Sản phẩm đã được xóa!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }
    }

    public function getInfo($id_product){
        $product = productModel::find($id_product);
        $path = $product->images_list;
        $files = \File::allFiles($path);

        foreach ($files as $file) {
            return '<img src="'.asset($file).'"/>';
        }

        return $product->specification;
    }

    public function getBoxSearch(Request $request){
        $products = productModel::where('name', 'like', '%' . $request->slug . '%')->orWhere('chip', 'like', '%' . $request->slug . '%')->take(5)->get() ;

        return view('xml.boxSearch', ['products' => $products]);
    }

    public function getBoxProduct(Request $request, $slug){
        $products = [];
        $cate = '';
        switch ($slug){
            case 'dien-thoai':
                $cate = 'Điện thoại';
                break;
            case 'laptop':
                $cate = 'Laptop';
                break;
            case 'may-tinh-ban':
                $cate = 'Máy tính bàn';
                break;
            case 'dong-ho-thong-minh':
                $cate = 'Đồng hồ thông minh';
                break;
            case 'may-tinh-bang':
                $cate = 'Máy tính bảng';
                break;
            case 'phu-kien':
                $cate = 'Phụ kiện';
                break;
        }

        $sql = 'SELECT DISTINCT *, products.id as product_id, products.name as product_name, brands.name as brand_name FROM products, brands WHERE products.brand_id = brands.id AND category = \''.$cate.'\' ';

        if ($request->arrayBrand){
            $sql .= 'AND brand_id IN (';
            $brands = $request->arrayBrand;
            foreach ($brands as $brand){
                $brand = json_decode($brand);
                $sql .= $brand->brand .',';
            }
            $sql = substr($sql,0,strlen($sql)-1);
            $sql .= ')';
        }

        if ($request->arrayPrice){
            $sql .= 'AND ( ';
            $prices = $request->arrayPrice;
            foreach ($prices as $price){
                $price = json_decode($price);
                if ($price->price == 5) {
                    $sql .= 'price BETWEEN 0 AND 5000000 OR ';
                }
                if ($price->price == 10) {
                    $sql .= 'price BETWEEN 5000000 AND 10000000 OR ';
                }
                if ($price->price == 15) {
                    $sql .= 'price BETWEEN 10000000 AND 15000000 OR ';
                }
                if ($price->price == 20) {
                    $sql .= 'price BETWEEN 15000000 AND 20000000 OR ';
                }
                if ($price->price == 25) {
                    $sql .= 'price >= 20000000    ';
                }
            }
            $sql = substr($sql,0,strlen($sql)-3);
            $sql .= ')';
        }

        $products = DB::select($sql);

        return view('xml.boxProduct', ['products' => $products]);
    }


    public function getViewProductDetail($id_product){
        $product = productModel::find($id_product);
        $product->view += 1;
        $product->save();
        return view('guest.product.product_detail', ['product'=>$product]);
    }


    public function getComment(Request $request){
        $comments = productModel::find($request->id)->comment->sortByDesc('created_at');

        return view('xml.listComment', ['comments' => $comments]);
    }

}
