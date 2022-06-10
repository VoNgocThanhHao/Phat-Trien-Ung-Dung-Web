<?php

namespace App\Http\Controllers;

use App\Models\ToolsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    public function getView(){
        $favourites = User::find(Auth::user()->id)->favourite;

        return view('guest.transaction.transaction_all', ['favourites' => $favourites]);
    }
}
