<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FoodsImport;

class FoodController extends Controller
{
    //
    
    public function index()
    {
        $foods = Food::all();
        return view('admin.food', compact(['foods']));
    }

    public function fut()
    {
        $food = Food::all();
        return view('user.cekkalori', compact(['food']));        
    }

    public function import(Request $request)
    {
        Excel::import(new FoodsImport, $request->file('file'));
        return redirect('/foods'); 
        // dd($request->file('file'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Food::whereIn('id',$ids)->delete();
        return response()->json(["Success"=>"Nutrisi yang anda pilih sudah berhasil di hapus"]);
    }
}
