<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Body;
use App\Models\Kalori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {

        $listuser = Users::where('usertype', 'user')
            ->select('id', 'name', 'email', 'email_verified_at', 'ai', 'tlp', 'ttl', 'jk', 'password', 'usertype', 'remember_token', 'created_at', 'updated_at')
            ->get();

        return view('user.index',compact(['listuser']));
    }

    public function bodiesss()
    {
        $userType = auth()->user()->usertype;
        $userId = Auth::id();
        
        
        $bodies = Body::where('user', $userId)->get();
        

        return view('user.detailUser', compact('bodies'));
    }

    public function totalKaloriBeranda()
    {

        $userType = auth()->user()->usertype;
        $userId = Auth::id();
        
        $bodies = Body::where('user', $userId)->get();
        $calory = Kalori::where('user_id', $userId)->get();
        

        return view('user.detailUser', compact('bodies', 'calory'));


    }

}
