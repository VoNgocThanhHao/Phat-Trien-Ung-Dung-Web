<?php

namespace App\Http\Controllers;

use App\Models\profileModel;
use App\Models\ToolsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\Exception;
use ImageResize;
use App\Image;

class profileController extends Controller
{
    public function getView($id_user){
        $user = User::find($id_user);
        return view('admin.profile.profile_home',['user'=>$user]);
    }

    public function update($id, Request $request){
        try {
            $user = User::find($id);
            $user->name = $request->input('name');


            $profile = $user->profile;

            if ($request->image != null) {
                $image_array_1 = explode(";", $request->image);
                $image_array_2 = explode(",", $image_array_1[1]);
                $data = base64_decode($image_array_2[1]);
                $imageName = time() . '.png';
                file_put_contents(public_path('mySource/imgs/avatars/'.$imageName), $data);
                $profile->image = 'public/mySource/imgs/avatars/'.$imageName;
            }


            $img                     =       ImageResize::make($profile->image);
            // --------- [ Resize Image ] ---------------

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
            })->save($profile->image);


            $profile->description = $request->input('description');
            $profile->phone_number = $request->input('phone_number');
            $profile->address = $request->input('address');

            $user->save();
            $profile->save();

            return ToolsModel::status('Tài khoản đã được cập nhật!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }
    }

    public function updateGuest(Request $request){
        try {
            $id = Auth::user()->id;

            $user = User::find($id);
            $user->name = $request->input('name');


            $profile = $user->profile;

            if ($request->image != null) {
                $image_array_1 = explode(";", $request->image);
                $image_array_2 = explode(",", $image_array_1[1]);
                $data = base64_decode($image_array_2[1]);
                $imageName = time() . '.png';
                file_put_contents(public_path('mySource/imgs/avatars/'.$imageName), $data);
                $profile->image = 'public/mySource/imgs/avatars/'.$imageName;
            }


            $img                     =       ImageResize::make($profile->image);
            // --------- [ Resize Image ] ---------------

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
            })->save($profile->image);


            $profile->description = $request->input('description');
            $profile->phone_number = $request->input('phone_number');
            $profile->address = $request->input('address');

            $user->save();
            $profile->save();

            return ToolsModel::status('Tài khoản đã được cập nhật!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }
    }

}
