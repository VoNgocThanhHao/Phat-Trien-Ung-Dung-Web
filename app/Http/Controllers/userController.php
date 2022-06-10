<?php

namespace App\Http\Controllers;

use App\Models\profileModel;
use App\Models\ToolsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function getView(){
        return view('admin.user.user_home');
    }

    public function getDataTable(Request $request){
        $users = User::all()->sortBy('email');
        return datatables()->of($users)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return '<a href="'.action('App\Http\Controllers\profileController@getView',$row->id).'">'.$row->name.'</a>';
            })
            ->addColumn('verified', function ($row) {
                $checked = '';
                if($row->email_verified_at != null) $checked='checked';
                return '<div class="custom-control custom-checkbox" >
                        <input class="custom-control-input" type="checkbox" id="customCheckbox2" '.$checked.' disabled>
                        <label for="customCheckbox2" class="custom-control-label"></label>
                        </div>';
            })->addColumn('permission', function ($row) {
                if ($row->permission == 1) $permission = 'Khách hàng';
                elseif ($row->permission == 2) $permission = 'Nhân viên';
                elseif ($row->permission == 3) $permission = 'Quản trị viên';
                return $permission;
            })->addColumn('action', function ($row) {
                $data = User::find($row->id)->toArray();
                $list = ['id','name','email','email_verified_at', 'permission'];
                $json_data = (new ToolsModel())->getJson($data,$list);

                $html = '<div class="btn btn-outline-secondary btn-sm btnEdit" data = \''.$json_data.'\'><i class="fa-solid fa-pencil"></i> Cập nhật </div>';
                $html .= '<div class="btn btn-outline-danger btn-sm btnDelete ml-2" data="'.$row->id.'"><i class="fa-solid fa-trash"></i> Xóa </div>';
                return $html;
            })
            ->rawColumns(['verified', 'action', 'name'])
            ->toJson();

    }

    public function addUser(Request $request){
        try {

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->verified == 'true') $user->email_verified_at = Carbon::now();
            $user->password = bcrypt($request->password);
            $user->permission = $request->permission;
            $user->save();

            $profile = new profileModel;
            $profile->user_id = $user->id;
            $profile->image= 'public/mySource/imgs/avatars/unknow.jpg';

            $profile->save();
            return ToolsModel::status('Tài khoản đã được thêm!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }

    }

    public function updateUser(Request $request){
        try {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->verified == 'true') $user->email_verified_at = Carbon::now();
            else $user->email_verified_at = null;
            $user->permission = $request->permission;
            $user->save();
            return ToolsModel::status('Tài khoản đã được cập nhật!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }
    }

    public function deleteUser(Request $request){
        try {
            $profile = profileModel::where('user_id',$request->id)->first();
            $user = User::find($request->id);

            if($profile->image != 'public/mySource/imgs/avatars/unknow.jpg')  \File::delete($profile->image);

            $user->delete();
            $profile->delete();

            return ToolsModel::status('Tài khoản đã được xóa!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }
    }

    public function changePassword(Request $request){
        try {
            $user = User::find($request->id);
            $user->password = $request->password;
            $user->save();
            return ToolsModel::status('Mật khẩu đã được thay đổi!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }
    }


    public function checkEmail(Request $request){
        $user = User::where('email',$request->email)->first();
        if ($user)
            return true;
        return false;
    }

    public function checkEmail_update(Request $request){
        $user = User::where('email',$request->input('email'))->where('id','!=',$request->input('id'))->first();
        if ($user)
            return true;
        return false;
    }

    public function regis(Request $request){
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->permission = 1;
            $user->save();

            $profile = new profileModel;
            $profile->user_id = $user->id;
            $profile->image= 'public/mySource/imgs/avatars/unknow.jpg';

            $profile->save();
            return ToolsModel::status('Tài khoản của bạn đã được đăng ký thành công!', 200);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }
    }

    public function changePass(Request $request){
        try {
            $user = User::find(Auth::user()->id);
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = bcrypt($request->new_password);
                $user->save();
                return ToolsModel::status('Mật khẩu của bạn đã được thay đổi thành công!', 200);
            }
            return ToolsModel::status('Mật khẩu hiện tại không chính xác!', 500);
        }catch (\Exception $exception){
            return ToolsModel::status('Máy chủ không phản hồi!', 500);
        }

    }

}
