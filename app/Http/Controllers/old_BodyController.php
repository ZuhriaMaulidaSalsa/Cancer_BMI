<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Body;
use Illuminate\Support\Facades\Auth;

class BodyController extends Controller
{
    public function index()
    {
        $bodies = Body::all();
        return view('user.body', compact('bodies'));
    }

    public function hitungIMT(Request $request)
    {
        $request->validate([
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
        ]);

        $berat_badan = $request->input('berat_badan');
        $tinggi_badan = $request->input('tinggi_badan');
        $bmi = $berat_badan / (($tinggi_badan / 100) ** 2);
        $status_gizi = $this->getStatusGizi($bmi);

        // Simpan data ke dalam database
        $body = new Body();
        $body->user = Auth::id(); // Pastikan menggunakan nama kolom yang tepat
        $body->berat_badan = $berat_badan;
        $body->tinggi_badan = $tinggi_badan;
        $body->imt = $bmi;
        $body->status_gizi = $status_gizi;
        $body->save();

        // Redirect dengan pesan sukses
        return redirect()->route('user.body')->with('success', 'Data IMT telah dihitung dan disimpan.');
    }

    private function getStatusGizi($bmi)
    {
        // Tulis logika untuk menentukan status gizi berdasarkan nilai BMI
        // Contoh:
        if ($bmi < 18.5) {
            return 'Underweight';
        } elseif ($bmi >= 18.5 && $bmi < 24.9) {
            return 'Normal';
        } elseif ($bmi >= 24.9 && $bmi < 29.9) {
            return 'Overweight';
        } else {
            return 'Obese';
        }
    }
}
