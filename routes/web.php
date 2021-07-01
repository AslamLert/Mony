<?php

use App\Http\Controllers\TransectionsController;
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

Route::get('/admin',[TransectionsController::class,'index'])->name('admin');
Route::post('/admin/add',[TransectionsController::class,'addTransection'])->name('NameAddTransection');
Route::get('/admin/edit/{id}',[TransectionsController::class,'edit']);
Route::post('/admin/update/{id}',[TransectionsController::class,'update'])->name('NameEditTransection');
Route::get('/admin/delete/{id}',[TransectionsController::class,'delete']);