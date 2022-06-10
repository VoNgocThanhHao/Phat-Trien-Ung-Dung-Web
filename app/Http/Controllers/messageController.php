<?php

namespace App\Http\Controllers;

use App\Events\messageSent;
use App\Events\notification;
use App\Models\messageModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class messageController extends Controller
{
    public function getList(Request $request){
        $messages = User::find(Auth::user()->id)->message;

        return view('xml.listMess',['messages'=>$messages]);
    }

    public function getListAdmin(Request $request){
        $messages = User::find($request->id)->message;

        foreach ($messages as $message){
            $message->read = 1;
            $message->save();
        }

        return view('xml.listMessAdmin',['messages'=>$messages]);
    }

    public function getListUser(){
        $users_id = messageModel::orderBy('created_at','desc')->get();
        $users = [];
        $id = -1;
        foreach ($users_id as $user){
            if ($id != $user->user_id){
                $id = $user->user_id;
                $isset = false;
                foreach ($users as $item){
                    if ($item->id == $id) {
                        $isset = true;
                        break;
                    }
                }
                if (!$isset) $users[] = User::find($user->user_id);
            }
        }

        return view('xml.listMessUser', ['users'=>$users]);
    }

    public function getView(){
        $users = User::all();
        return view('admin.message.message_home', ['users'=>$users]);
    }

    public function sentMess(Request $request){
        $mess = new messageModel();
        $mess->content = $request->message;
        $mess->type = 0;
        $mess->read = 0;
        $mess->user_id = Auth::user()->id;
        $mess->save();

        $qty = messageModel::where('read',0)->count();

        broadcast(new notification('message',$qty));
        broadcast(new messageSent(auth()->user(), $request->message));
//        return $request->message;
    }

    public function sentMessAdmin(Request $request){
        $mess = new messageModel();
        $mess->content = $request->message;
        $mess->type = 1;
        $mess->read = 1;
        $mess->user_id = $request->id;
        $mess->save();

        broadcast(new messageSent(User::find($request->id), $request->message));
    }

    public function getCountMess(){
        return messageModel::where('read',0)->count();
    }
}
