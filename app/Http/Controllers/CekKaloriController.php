<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\Models\Food as ModelsFood;
use App\Models\Kalori;
use App\Models\Food;

class CekKaloriController extends Controller
{
    //
    public function index(Request $request)
    {
        $foods = Food::all();
        $uniqueCategories = Food::select('kategori')->distinct()->pluck('kategori');
        $categories = $uniqueCategories->toArray(); 

        if ($request->data) {
            $data = Kalori::where('user_id', auth()->user()->id)->where('id', $request->data)->first();
            return view('user.cekkalori', compact('data', 'categories'));
           
        }

        return view('user.cekkalori', compact('categories'));

    }

    public function getFoodsByCategory($categoryId)
    {
        $foods = Food::where('kategori', $categoryId)->get();
        return response()->json($foods);
    }

    public function create(Request $request)
    {
        if ($request->kategori == true) {
            $data = ModelsFood::groupBy('kategori')->get('kategori');
            // dd($data);
            $data = $data->reject(function ($value, $key) {
                return $value->kategori == null;
            });
            return response()->json($data);
        }
        if ($request->nama_kategori) {
            $data = ModelsFood::where('kategori', $request->nama_kategori)->get();
            return response()->json($data);
        }

        $data = ModelsFood::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'pilihan_kategori_mp.*' => 'required',
            'pilihan_kategori_ms.*' => 'required',
            'pilihan_kategori_mm.*' => 'required',
            'pilihan_menu_mp.*' => 'required', 
            'pilihan_menu_ms.*' => 'required', 
            'pilihan_menu_mm.*' => 'required', 
            'kuantitas_urt_gram_mp.*' => 'required',
            'kuantitas_urt_gram_ms.*' => 'required',
            'kuantitas_urt_gram_mm.*' => 'required',
        ]);


        $request->merge([
            'pilihan_menu' => array_merge(
                $request->pilihan_menu_mp, 
                $request->pilihan_menu_ms, 
                $request->pilihan_menu_mm
            ),
            'kuantitas' => array_merge(
                $request->kuantitas_urt_gram_mp, 
                $request->kuantitas_urt_gram_ms,
                $request->kuantitas_urt_gram_mm
            ),
        ]);


        // cek apakah pilihan_menu dan kuantitas memiliki jumlah yang sama
        if (count($request->pilihan_menu) != count($request->kuantitas)) {
            return redirect()->back()->with('error', "Jumlah menu dan kuantitas tidak sama");
        }

        $makanan = [];
        $kalori = [];
        $kuantitas = [];
        $kategori = [];
        $satuan = []; 

        // ================== MAKAN PAGI
        $i = 0;
        foreach ($request->pilihan_menu_mp as $value) {
            $data = ModelsFood::where('id', $value)->first();
            $makanan['makan_pagi'][$i] = $data->nama;
            $kuantitas['makan_pagi'][$i] = $request->kuantitas_urt_gram_mp[$i];
            $kategori['makan_pagi'][$i] = $data->kategori;
            

            if ($request->satuan_mp[$i] == 'gram') {
                $kalori['makan_pagi'][$i] = ($data->kalorigram / $data->berat) * $request->kuantitas_urt_gram_mp[$i];
                $satuan['makan_pagi'][$i] = $data->berat;
            } elseif ($request->satuan_mp[$i] == 'urt') {
                $kalori['makan_pagi'][$i] = $data->kaloriurt * $request->kuantitas_urt_gram_mp[$i];
                $satuan['makan_pagi'][$i] = $data->urt;
            }

            $i++;
        }

        // ================== MAKAN SIANG
        $i = 0;
        foreach ($request->pilihan_menu_ms as $value) {
            $data = ModelsFood::where('id', $value)->first();
            $makanan['makan_siang'][$i] = $data->nama;
            $kuantitas['makan_siang'][$i] = $request->kuantitas_urt_gram_ms[$i];
            $kategori['makan_siang'][$i] = $data->kategori;
            

            if ($request->satuan_ms[$i] == 'gram') {
                $kalori['makan_siang'][$i] = ($data->kalorigram / $data->berat) * $request->kuantitas_urt_gram_ms[$i];
                $satuan['makan_siang'][$i] = $data->berat;
            } elseif ($request->satuan_ms[$i] == 'urt') {
                $kalori['makan_siang'][$i] = $data->kaloriurt * $request->kuantitas_urt_gram_ms[$i];
                $satuan['makan_siang'][$i] = $data->urt;
            }

            $i++;
        }

        // ================== MAKAN MALAM
        $i = 0;
        foreach ($request->pilihan_menu_mm as $value) {
            $data = ModelsFood::where('id', $value)->first();
            $makanan['makan_malam'][$i] = $data->nama;
            $kuantitas['makan_malam'][$i] = $request->kuantitas_urt_gram_mm[$i];
            $kategori['makan_malam'][$i] = $data->kategori;
            

            if ($request->satuan_mm[$i] == 'gram') {
                $kalori['makan_malam'][$i] = ($data->kalorigram / $data->berat) * $request->kuantitas_urt_gram_mm[$i];
                $satuan['makan_malam'][$i] = $data->berat;
            } elseif ($request->satuan_mm[$i] == 'urt') {
                $kalori['makan_malam'][$i] = $data->kaloriurt * $request->kuantitas_urt_gram_mm[$i];
                $satuan['makan_malam'][$i] = $data->urt;
            }

            $i++;
        }

        // Menyimpan semua data dalam satu variabel array
        $data_dd = [
            'makanan' => $makanan,
            'kalori' => $kalori,
            'kuantitas' => $kuantitas,
            'kategori' => $kategori,
            'satuan' => $satuan
        ];
        
        
        $sumKalori = intval(array_sum($kalori['makan_pagi']) + array_sum($kalori['makan_siang']) + array_sum($kalori['makan_malam']));
        


        $dbKalori = Kalori::create([
            'user_id' => auth()->user()->id,
            'kalori_pagi' => array_sum($kalori['makan_pagi']),
            'kalori_siang' => array_sum($kalori['makan_siang']),
            'kalori_malam' => array_sum($kalori['makan_malam']),

            'makan_pagi' => implode(", ", $makanan['makan_pagi']),
            'makan_siang' => implode(", ", $makanan['makan_siang']),
            'makan_malam' => implode(", ", $makanan['makan_malam']),

            'kategori_pagi' => implode(", ", $kategori['makan_pagi']),
            'kategori_siang' => implode(", ", $kategori['makan_siang']),
            'kategori_malam' => implode(", ", $kategori['makan_malam']),

            'kuantitas_pagi' => implode(", ", $kuantitas['makan_pagi']),
            'kuantitas_siang' => implode(", ", $kuantitas['makan_siang']),
            'kuantitas_malam' => implode(", ", $kuantitas['makan_malam']),

            'satuan_pagi' => implode(", ", $satuan['makan_pagi']), 
            'satuan_siang' => implode(", ", $satuan['makan_siang']),
            'satuan_malam' => implode(", ", $satuan['makan_malam']),
        ]);
        
        // dd($dbKalori);
        $categories = Food::select('kategori')->distinct()->pluck('kategori')->toArray();
        return view('user.cekkalori')->with(['dbKalori' => $dbKalori, 'sumKalori' => $sumKalori, 'categories' => $categories])->with('success', "Kalori yang anda konsumsi hari ini adalah " . $sumKalori . " kalori");

        // return redirect()->route('user.cekkalori', ['data' => $dbKalori])->with('success', "Kalori yang anda konsumsi hari ini adalah " . $sumKalori . " kalori");
    }

    public function show(string $id)
    {
        $data=Kalori::where('id', $id)->first();
        return response()->json($data);
    }
    
}
        

      