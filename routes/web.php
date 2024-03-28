<?php

use App\Http\Controllers\Admin\PdfController;
use App\Models\Premio;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $images = Premio::where('active', true)
        ->where('image', '!=', null)
        ->select('image', 'name')
        ->get()
        ->map(function ($image) {
            $image->image = asset('storage/events/' . $image->image);
            return $image->only(['image', 'name']);
        });

    $premios = Premio::where('active', true)
        ->get()
        ->count();
    return view('welcome', compact('images', 'premios'));
})->name('home');

Route::get('registro', function () {
    return view('register-form');
})->name('register.form');

Route::get('gracias', function () {
    return view('gracias');
})->name('gracias');

Route::get('prueba', function () {
    $images = Premio::where('active', true)
        ->where('image', '!=', null)
        ->select('image', 'name')
        ->get()
        ->map(function ($image) {
            $image->image = asset('storage/events/' . $image->image);
            return $image->only(['image', 'name']);
        });
    // return $images;
    // dd($images);
    return view('prueba', compact('images'));
})->name('prueba');

Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/premios', function () {
        return view('dashboard');
    })->name('premios');
});

Route::get('/test', [PdfController::class, 'test'])->name('print.test');
