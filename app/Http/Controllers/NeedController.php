<?php

namespace App\Http\Controllers;

use App\Models\Body;
use Illuminate\Http\Request;

class NeedController extends Controller
{
    //
    public function index()
    {
        $bodies = Body::all();
        return view('user.need', [
            'beratBadan' => null,
            'tinggiBadan' => null,
            'usia' => null,
            'jenisKelamin' => null,
            'kalori' => null,
        ]);
    }

    // Method untuk menghitung kebutuhan kalori berdasarkan data yang diterima dari form
    public function hitungKalori(Request $request)
    {
        // Lakukan validasi data input
        $validatedData = $request->validate([
            'jenis_kelamin' => 'required',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'usia' => 'required|numeric',
            'aktifitas' => 'required',
        ]);

        // Ambil data dari request
        $jenisKelamin = $validatedData['jenis_kelamin'];
        $beratBadan = $validatedData['berat_badan'];
        $tinggiBadan = $validatedData['tinggi_badan'];
        $usia = $validatedData['usia'];
        $aktifitas = $validatedData['aktifitas'];

        // Hitung BMR (Basal Metabolic Rate) menggunakan rumus Harris-Benedict
        // Sesuaikan rumus ini sesuai kebutuhan Anda
        $bmr = 0;

        if ($jenisKelamin == 'Laki-laki') {
            $bmr = 66.5 + (13.7 * $beratBadan) + (5 * $tinggiBadan) - (6.8 * $usia);
        } elseif ($jenisKelamin == 'Perempuan') {
            $bmr = 655 + (9.6 * $beratBadan) + (1.8 * $tinggiBadan) - (4.7 * $usia);
        }

        // Hitung kebutuhan kalori harian berdasarkan BMR dan tingkat aktivitas
        $kalori = 0;

        // Sesuaikan faktor aktivitas berdasarkan kategori aktivitas
        if ($aktifitas == 'Ringan') {
            $kalori = $bmr * 1.2;
        } elseif ($aktifitas == 'Sedang') {
            $kalori = $bmr * 1.3;
        } elseif ($aktifitas == 'Berat') {
            $kalori = $bmr * 1.4;
        }

        // Tampilkan view dengan hasil perhitungan
        return view('user.need', compact('kalori', 'jenisKelamin', 'beratBadan', 'tinggiBadan', 'usia'));
    }
}