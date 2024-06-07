<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Body;
use Illuminate\Support\Facades\Auth;


class BodyController extends Controller
{
    public function index()
    {
        // Mengambil id pengguna yang sedang login
        $userId = Auth::id();

        // Mengambil data bodies milik pengguna yang sedang login
        $bodies = Body::where('user', $userId)->get();

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

        $body = new Body();
        $body->user = Auth::id();
        $body->berat_badan = $berat_badan;
        $body->tinggi_badan = $tinggi_badan;
        $body->imt = $bmi;
        $body->status_gizi = $status_gizi;
        $body->save();

        // Mengambil data tubuh terbaru
        $latestBody = Body::where('user', Auth::id())->latest()->first();

        // Mengirimkan data tubuh terbaru ke tampilan
        return view('user.body', compact('latestBody'))->with('success', 'IMT telah dihitung dan disimpan.');
    }

    private function getStatusGizi($bmi)
    {
        // Tulis logika untuk menentukan status gizi berdasarkan nilai BMI
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