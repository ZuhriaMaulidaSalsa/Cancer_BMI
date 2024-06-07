<?php

namespace App\Http\Controllers;
use App\Models\Body;
use App\Models\Food;
use App\Models\Category;
use App\Models\Kalori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
    {
        // Periksa jenis pengguna yang masuk
        $userType = auth()->user()->usertype;
        $userId = Auth::id();

        if ($userType === 'admin') {
            // Jika pengguna adalah admin, ambil semua data dari tabel bodies
            $bodies = Body::all();
        } else {
            // Jika pengguna adalah pengguna biasa, ambil hanya data dari pengguna yang sedang masuk
            $bodies = Body::where('user', $userId)->get();
        }

        return view('user.beranda', compact('bodies'));
    }

    public function totalKaloriBeranda()
    {

        $userType = auth()->user()->usertype;
        $userId = Auth::id();

        if ($userType === 'admin') {
            // Jika pengguna adalah admin, ambil semua data dari tabel bodies
            $bodies = Body::all();
            $calory = Kalori::all();
        } else {
            // Jika pengguna adalah pengguna biasa, ambil hanya data dari pengguna yang sedang masuk
            $bodies = Body::where('user', $userId)->get();
            $calory = Kalori::where('user_id', $userId)->get();
        }

        return view('user.beranda', compact('bodies', 'calory'));


    }
}
