<?php

use App\Http\Livewire\Admin\Banks;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Kategoris;
use App\Http\Livewire\Admin\Transaksis;
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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('kategori', Kategoris::class)->name('kategori');
    Route::get('bank', Banks::class)->name('bank');
    Route::get('transaksi', Transaksis::class)->name('transaksi');
});
