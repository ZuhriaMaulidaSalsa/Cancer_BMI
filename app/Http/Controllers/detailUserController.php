<?php

namespace App\Http\Controllers;
use App\Models\Body;
use App\Models\Food;
use App\Models\Category;
use App\Models\Kalori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class detailUser extends Controller
{
    public function index()
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
