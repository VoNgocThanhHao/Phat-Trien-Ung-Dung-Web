<?php

namespace App\Http\Controllers;

use App\Models\ToolsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function getView(){
        return view('admin.login.login_home');
    }

    public function loginAdmin(Request $request){
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email'=>$email,'password'=>$password])){
            if (Auth::user()->permission == 2 || Auth::user()->permission == 3)
                return ToolsModel::status('Đăng nhập thành công', 200);
            Auth::logout();
        }

        return ToolsModel::status('Sai tài khoản hoặc mật khẩu!', 500);
    }

    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email'=>$email,'password'=>$password])){
            return ToolsModel::status('Đăng nhập thành công', 200);
        }
        return ToolsModel::status('Sai tài khoản hoặc mật khẩu!', 500);
    }
}
