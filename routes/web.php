<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\CheckAdminLogin;
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
//homeuser
Route::prefix('/')->group(function () {
     Route::get('/', [Homecontroller::class, 'index']);
     Route::get('/trangchu', [Homecontroller::class, 'index']);
});

Route::prefix('/user')->group(function () {
     Route::get('/danhmuc/danhmuc/{id}', [Homecontroller::class, 'hienthidanhmuc']);
});

//admin
Route::middleware('checkadminlogin')->group(function () {
     Route::get('/admin/index', [AdminController::class, 'showhome']);
});
 
Route::prefix('/admin')->group(function () {
     Route::get('/', [AdminController::class, 'login']);
     Route::get('/login', [AdminController::class, 'login']);
     Route::get('/logout', [AdminController::class, 'logout']);
     Route::post('/loginaction', [AdminController::class, 'loginaction']);
});
 
//admin-danhmuc
Route::prefix('/admin/danhmuc')->middleware('checkadminlogin')->group(function () {
     Route::get('/hienthi', [CategoryController::class, 'hienthi']);
     Route::get('/them', [CategoryController::class, 'them']);
     Route::get('/sua/{id}', [CategoryController::class, 'sua']);
     Route::get('/hidden/{id}', [CategoryController::class, 'hidden']);
     Route::get('/show/{id}', [CategoryController::class, 'show']);

     Route::post('/action_them', [CategoryController::class, 'action_them']);
     Route::post('/action_sua/{id}', [CategoryController::class, 'action_sua']);
     Route::post('/xoa/{id}', [CategoryController::class, 'xoa']);
});

//admin-chude
Route::prefix('/admin/chude')->middleware('checkadminlogin')->group(function () {
     Route::get('/hienthi', [SubcategoryController::class, 'hienthi']);
     Route::get('/them', [SubcategoryController::class, 'them']);
     Route::get('/sua/{id}', [SubcategoryController::class, 'sua']);
     Route::get('/hidden/{id}', [SubcategoryController::class, 'hidden']);
     Route::get('/show/{id}', [SubcategoryController::class, 'show']);

     Route::post('/action_sua/{id}', [SubcategoryController::class, 'action_sua']);
     Route::post('/xoa/{id}', [SubcategoryController::class, 'xoa']);
     Route::post('/action_them', [SubcategoryController::class, 'action_them']);
}); 

//admin-baiviett
Route::prefix('/admin/baiviet')->group(function () {
     Route::get('/hienthi', [PostController::class, 'hienthi']);
     Route::get('/them', [PostController::class, 'them']);
     Route::get('/sua/{id}', [PostController::class, 'sua']);
     Route::get('/hidden/{id}', [PostController::class, 'hidden']);
     Route::get('/show/{id}', [PostController::class, 'show']);

     Route::post('/action_sua/{id}', [PostController::class, 'action_sua']);
     Route::post('/xoa/{id}', [PostController::class, 'xoa']);
     Route::post('/action_them', [PostController::class, 'action_them']);
});
