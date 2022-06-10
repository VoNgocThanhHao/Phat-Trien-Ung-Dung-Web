<?php

namespace App\Http\Controllers;

use App\Events\commentProduct;
use App\Events\messageSent;
use App\Models\commentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class commentController extends Controller
{
    public function sentComment(Request $request){
        $comment = new commentModel();
        $comment->content = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->product_id = $request->product_id;
        $comment->save();

        broadcast(new commentProduct($request->product_id));
    }
}
