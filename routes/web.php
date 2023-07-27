<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\DB;
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
    return view('welcome');
});

Route::get('/home', function () {
    return "This is home page";
});

Route::get('/about', function () {
    return "This is about page";
})->middleware('check');

Route::get('/contact', [ContactController::class, 'index'])->name('con');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {

        // $users = User::all();
        $users = DB::table('users')->get();

        return view('dashboard', compact('users'));
    })->name('dashboard');
});
