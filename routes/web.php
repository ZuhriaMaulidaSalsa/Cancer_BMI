<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CekKaloriController;
use App\Http\Controllers\BodyController;
use App\Http\Controllers\NeedController;
use App\Http\Controllers\detailUserController;
use App\Http\Controllers\NutrisiglobalController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

// route::get('post', [HomeController::class, 'post'])->middleware(['auth', 'admin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/listUser', [\App\Http\Controllers\UsersController::class, 'index']);
    Route::get('/foods', [\App\Http\Controllers\FoodController::class, 'index']);
    Route::post('/foods-import', [\App\Http\Controllers\FoodController::class, 'import']);
    Route::delete('/food/delete', [FoodController::class, 'deleteAll'])->name('food.delete');
    Route::get('/nutritions', [\App\Http\Controllers\NutrisiglobalController::class, 'index']);
});

Route::get('/cekKalori', [\App\Http\Controllers\CekKaloriController::class, 'index'])->name('cekKalori');
Route::get('/form', [App\Http\Controllers\CategoryController::class, 'showForm']);
Route::get('/bodies', [\App\Http\Controllers\BodyController::class, 'index']);
Route::post('/bodies', [\App\Http\Controllers\BodyController::class, 'index']);
Route::get('/needs', [\App\Http\Controllers\NeedController::class, 'index']);
Route::post('/needs', [\App\Http\Controllers\NeedController::class, 'index']);
Route::get('/beranda', [\App\Http\Controllers\BerandaController::class, 'index']);
Route::get('/beranda', [\App\Http\Controllers\BerandaController::class, 'totalKaloriBeranda']);
Route::get('/get-foods-by-category/{categoryId}', [\App\Http\Controllers\CekKaloriController::class, 'getFoodsByCategory']);
Route::get('/get-food-details/{foodId}', [\App\Http\Controllers\CekKaloriController::class, 'getFoodDetails']);
Route::post('/simpan-data', [App\Http\Controllers\CekKaloriController::class, 'simpanData'])->middleware('auth')->name('simpan-data');



Route::post('/hitung-imt', [BodyController::class, 'hitungIMT'])->name('hitungIMT');
Route::get('/hitung-imt', [BodyController::class, 'hitungIMT'])->name('hitung.imt');
Route::get('/user/body', [BodyController::class, 'index'])->name('user.body');

// Route untuk menampilkan form perhitungan kebutuhan kalori
Route::get('/hitung-kalori', [NeedController::class, 'index'])->name('hitung.kalori');

// Route untuk menghitung kebutuhan kalori
Route::post('/hitung-kalori', [NeedController::class, 'hitungKalori'])->name('hitung.kalori.post');

Route::post('/store-data', [App\Http\Controllers\CekKaloriController::class, 'store'])->name('store');


Route::get('/detail', [\App\Http\Controllers\UsersController::class, 'bodiesss']);
Route::get('/detail', [\App\Http\Controllers\UsersController::class, 'totalKaloriBeranda']);
