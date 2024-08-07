<?php

use App\Http\Controllers\Admin\TicketController;
use App\Models\Premio;
use App\Models\User;
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

Route::middleware('auth')
    ->get('tickets', [TicketController::class, 'tickets'])
    ->name('tickets');

//prueba------------------------------------------------------------
Route::get('prueba', function () {
    // event(new \App\Events\UserRegisteredEvent(\App\Models\RegisterUser::find(64)));
    return 'emitiendo evento...';
})->middleware('first.user')->name('prueba');
//prueba------------------------------------------------------------

Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'first.user'
])->group(function () {
    Route::get('/premios', function () {
        return view('dashboard');
    })->name('premios');
    Route::get('/solicitudes', function () {
        return view('solicitudes');
    })->name('solicitudes');
    Route::get('/participantes', function () {
        return view('participantes');
    })->name('participantes');
    Route::get('/mis_tickets/{user}', function (User $user) {
        return view('mis_tickets', compact('user'));
    })->name('mis-tickets');
});
