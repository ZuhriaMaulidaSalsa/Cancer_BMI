<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NutrisiglobalController extends Controller
{
    public function index()
    {

        // Mengambil data dari JSON API
        $response = Http::get('https://cancer-api-amber.vercel.app/nutrition');
        $nutritions = $response->json();

        return view('admin.nutrisiglobal', compact('nutritions'));
    }
}
