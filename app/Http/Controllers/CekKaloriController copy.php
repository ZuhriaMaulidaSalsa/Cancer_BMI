<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Category;
use App\Models\Breakfast;
use App\Models\Lunch;
use App\Models\Dinner;
use App\Models\Body;

class CekKaloriController extends Controller
{
    //
    public function index()
    {
        $foods = Food::all();
        $categories = Category::all();

        // Mencoba nampilin data
        // $breakfastData = Breakfast::join('users', 'breakfasts.user_cek_kalori', '=', 'users.id')
        //     ->join('categories', 'breakfasts.pilihan_kategori_mp', '=', 'categories.id')
        //     ->join('food', 'breakfasts.pilihan_menu_mp', '=', 'food.id')
        //     ->select('users.name AS user_name', 'categories.nama_kategori AS category_name', 'food.nama AS menu_name', 'food.kaloriurt AS kalori')
        //     ->get();

        // $lunchData = Lunch::join('users', 'lunches.user_cek_kalori', '=', 'users.id')
        //     ->join('categories', 'lunches.pilihan_kategori_ms', '=', 'categories.id')
        //     ->join('food', 'lunches.pilihan_menu_ms', '=', 'food.id')
        //     ->select('users.name AS user_name', 'categories.nama_kategori AS category_name', 'food.nama AS menu_name', 'food.kaloriurt AS kalori')
        //     ->get();

        // $dinnerData = Dinner::join('users', 'dinners.user_cek_kalori', '=', 'users.id')
        //     ->join('categories', 'dinners.pilihan_kategori_mm', '=', 'categories.id')
        //     ->join('food', 'dinners.pilihan_menu_mm', '=', 'food.id')
        //     ->select('users.name AS user_name', 'categories.nama_kategori AS category_name', 'food.nama AS menu_name', 'food.kaloriurt AS kalori')
        //     ->get();

        // Mengambil data terakhir dari masing-masing tabel
        $lastBreakfast = Breakfast::join('users', 'breakfasts.user_cek_kalori', '=', 'users.id')
        ->join('categories', 'breakfasts.pilihan_kategori_mp', '=', 'categories.id')
        ->join('food', 'breakfasts.pilihan_menu_mp', '=', 'food.id')
        ->select(
            'food.kaloriurt AS kalori',
            'breakfasts.kuantitas_urt_gram_mp AS kuantitas',
            \DB::raw('food.kaloriurt * breakfasts.kuantitas_urt_gram_mp AS total_kalori')
        )
        ->latest('breakfasts.created_at')
        ->first();

        $lastLunch = Lunch::join('users', 'lunches.user_cek_kalori', '=', 'users.id')
        ->join('categories', 'lunches.pilihan_kategori_ms', '=', 'categories.id')
        ->join('food', 'lunches.pilihan_menu_ms', '=', 'food.id')
        // ->select('food.kaloriurt AS kalori', 'lunches.kuantitas_urt_gram_ms AS kuantitas')
        ->select(
            'food.kaloriurt AS kalori',
            'lunches.kuantitas_urt_gram_ms AS kuantitas',
            \DB::raw('food.kaloriurt * lunches.kuantitas_urt_gram_ms AS total_kalori')
        )
        ->latest('lunches.created_at')
        ->first();

        $lastDinner = Dinner::join('users', 'dinners.user_cek_kalori', '=', 'users.id')
        ->join('categories', 'dinners.pilihan_kategori_mm', '=', 'categories.id')
        ->join('food', 'dinners.pilihan_menu_mm', '=', 'food.id')
        // ->select('food.kaloriurt AS kalori', 'dinners.kuantitas_urt_gram_mm AS kuantitas')
        ->select(
            'food.kaloriurt AS kalori',
            'dinners.kuantitas_urt_gram_mm AS kuantitas',
            \DB::raw('food.kaloriurt * dinners.kuantitas_urt_gram_mm AS total_kalori')
        )
        ->latest('dinners.created_at')
        ->first();    
        
        // $latestBody = Body::where('user', Auth::id())->latest()->first();

        return view('user.cekkalori', compact('foods', 'categories', 'lastBreakfast', 'lastLunch', 'lastDinner'));        
    }    

    public function getFoodsByCategory($categoryId)
    {
        $foods = Food::where('nama_kategori', $categoryId)->get();
        return response()->json($foods);
    }
    
    public function getFoodDetails($foodId)
    {
        $food = Food::find($foodId);
        return response()->json($food);
    }

    public function simpanData(Request $request)
    {
        // Simpan data ke dalam tabel makan_siang
        $makanSiang = new Lunch();
        $makanSiang->user_cek_kalori = Auth::id();
        $makanSiang->pilihan_kategori_ms = $request->pilihan_kategori_ms;
        $makanSiang->pilihan_menu_ms = $request->pilihan_menu_ms;
        $makanSiang->kuantitas_urt_gram_ms = $request->kuantitas_urt_gram_ms;
        $makanSiang->save();

        // Simpan data ke dalam tabel makan_pagi
        $makanPagi = new Breakfast();
        $makanPagi->user_cek_kalori = Auth::id();
        $makanPagi->pilihan_kategori_mp = $request->pilihan_kategori_mp;
        $makanPagi->pilihan_menu_mp = $request->pilihan_menu_mp;
        $makanPagi->kuantitas_urt_gram_mp = $request->kuantitas_urt_gram_mp;
        $makanPagi->save();

        // Simpan data ke dalam tabel makan_malam
        $makanMalam = new Dinner();
        $makanMalam->user_cek_kalori = Auth::id();
        $makanMalam->pilihan_kategori_mm = $request->pilihan_kategori_mm;
        $makanMalam->pilihan_menu_mm = $request->pilihan_menu_mm;
        $makanMalam->kuantitas_urt_gram_mm = $request->kuantitas_urt_gram_mm;
        $makanMalam->save();
        
        return redirect()->back();
    }

    // public function hitungKalori()
    // {
    //     $makanPagi = Breakfast::where('user_cek_kalori', Auth::id())->first();
    //     $makanSiang = Lunch::where('user_cek_kalori', Auth::id())->first();
    //     $makanMalam = Dinner::where('user_cek_kalori', Auth::id())->first();

    //     // Ambil detail makanan berdasarkan id
    //     // $detailMakanPagi = $makanPagi->food;
    //     // $detailMakanSiang = $makanSiang->food;
    //     // $detailMakanMalam = $makanMalam->food;

    //     // Mengambil detail makanan jika data makanan tersedia
    //     $detailMakanPagi = $makanPagi ? $makanPagi->food : null;
    //     $detailMakanSiang = $makanSiang ? $makanSiang->food : null;
    //     $detailMakanMalam = $makanMalam ? $makanMalam->food : null;

    //     return view('user.cekkalori', compact('makanPagi', 'makanSiang', 'makanMalam', 'detailMakanPagi', 'detailMakanSiang', 'detailMakanMalam'));
    // }


    // public function getDataForDisplay()
    // {
    //     $data = DB::select("
    //         SELECT users.name AS 'user_name', 
    //             categories.nama_kategori AS 'kategori', 
    //             food.nama AS 'menu', 
    //             food.kaloriurt AS 'kalori'
    //         FROM breakfasts
    //         JOIN users ON breakfasts.user_cek_kalori = users.id
    //         JOIN categories ON breakfasts.pilihan_kategori_mp = categories.id
    //         JOIN food ON breakfasts.pilihan_menu_mp = food.id
    //         UNION
    //         SELECT users.name AS user_name, 
    //             categories.nama_kategori AS category_name, 
    //             food.nama AS menu_name, 
    //             food.kaloriurt AS kaloriurt
    //         FROM lunches
    //         JOIN users ON lunches.user_cek_kalori = users.id
    //         JOIN categories ON lunches.pilihan_kategori_ms = categories.id
    //         JOIN food ON lunches.pilihan_menu_ms = food.id
    //         UNION
    //         SELECT users.name AS user_name, 
    //             categories.nama_kategori AS category_name, 
    //             food.nama AS menu_name, 
    //             food.kaloriurt AS kaloriurt
    //         FROM dinners
    //         JOIN users ON dinners.user_cek_kalori = users.id
    //         JOIN categories ON dinners.pilihan_kategori_mm = categories.id
    //         JOIN food ON dinners.pilihan_menu_mm = food.id;
    //     ");

    //     return view('user.cekkalori', compact('data'));
    // }


    // public function hitungKalori()
    // {
    //     // Mengambil data dari tabel breakfasts, lunches, dan dinners
    //     $makanPagi = Breakfast::where('user_cek_kalori', auth()->id())->first();
    //     $makanSiang = Lunch::where('user_cek_kalori', auth()->id())->first();
    //     $makanMalam = Dinner::where('user_cek_kalori', auth()->id())->first();

    //     // Menghitung total kalori
    //     $totalKalori = 0;
    //     if ($makanPagi) {
    //         $totalKalori += $makanPagi->food->kaloriurt * $makanPagi->kuantitas_urt_gram_mp;
    //     }
    //     if ($makanSiang) {
    //         $totalKalori += $makanSiang->food->kaloriurt * $makanSiang->kuantitas_urt_gram_ms;
    //     }
    //     if ($makanMalam) {
    //         $totalKalori += $makanMalam->food->kaloriurt * $makanMalam->kuantitas_urt_gram_mm;
    //     }

    //     // Mengembalikan total kalori ke view
    //     return view('user.cekkalori', compact('totalKalori'));
    // }

}
