<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\PostController;
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
Route::get('/', [Homecontroller::class, 'index']);
Route::get('/trangchu', [Homecontroller::class, 'index']);
//user/hienthidanhmuc
Route::get('/user/danhmuc/danhmuc/{id}', [Homecontroller::class, 'hienthidanhmuc']);


//admin
Route::get('/admin', [AdminController::class, 'showhome']);
Route::get('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/logout', [AdminController::class, 'logout']);
Route::post('/admin/login', [AdminController::class, 'home']);


//admin-danhmuc
Route::get('/admin/danhmuc/hienthi', [CategoryController::class, 'hienthi']);
Route::get('/admin/danhmuc/them', [CategoryController::class, 'them']);
Route::post('/admin/danhmuc/action_them', [CategoryController::class, 'action_them']);
Route::post('/admin/danhmuc/action_sua/{id}', [CategoryController::class, 'action_sua']);
Route::get('/admin/danhmuc/sua/{id}', [CategoryController::class, 'suadm']);
Route::post('/admin/danhmuc/xoa/{id}', [CategoryController::class, 'xoadm']);
Route::get('/admin/danhmuc/hidden/{id}', [CategoryController::class, 'hidden']);
Route::get('/admin/danhmuc/show/{id}', [CategoryController::class, 'show']);
Route::get('/chi-tiet-san-pham/{idsp}', [CategoryController::class, 'chitietsp']);
Route::get('/admin/danhmuc/hidden/{id}', [CategoryController::class, 'hidden']);
Route::get('/admin/danhmuc/show/{id}', [CategoryController::class, 'show']);

//admin-chude
Route::get('/admin/chude/hienthi', [SubcategoryController::class, 'chudehienthi']);
Route::get('/admin/chude/them', [SubcategoryController::class, 'chudethem']);
Route::post('/admin/chude/action_them', [SubcategoryController::class, 'chudeaction_them']);
Route::post('/admin/chude/action_sua/{id}', [SubcategoryController::class, 'chudeaction_sua']);
Route::get('/admin/chude/sua/{id}', [SubcategoryController::class, 'chudesuadm']);
Route::post('/admin/chude/xoa/{id}', [SubcategoryController::class, 'chudexoadm']);
Route::get('/admin/chude/hiden/{id}', [SubcategoryController::class, 'chudehidden']);
Route::get('/admin/chude/show/{id}', [SubcategoryController::class, 'chudeshow']);
Route::get('/chi-tiet-san-pham/{idsp}', [SubcategoryController::class, 'chudechitietsp']);
Route::get('/admin/chude/hiden/{id}', [SubcategoryController::class, 'chudehidden']);
Route::get('/admin/chude/show/{id}', [SubcategoryController::class, 'chudeshow']);

//admin-baiviet
Route::get('/admin/baiviet/hienthi', [PostController::class, 'baiviethienthi']);
Route::get('/admin/baiviet/them', [PostController::class, 'baivietthem']);
Route::post('/admin/baiviet/action_them', [PostController::class, 'baivietaction_them']);
Route::post('/admin/baiviet/action_sua/{id}', [PostController::class, 'baivietaction_sua']);
Route::get('/admin/baiviet/sua/{id}', [PostController::class, 'baivietsuadm']);
Route::post('/admin/baiviet/xoa/{id}', [PostController::class, 'baivietxoadm']);
Route::get('/admin/baiviet/hidden/{id}', [PostController::class, 'baiviethidden']);
Route::get('/admin/baiviet/show/{id}', [PostController::class, 'baivietshow']);
Route::get('/chi-tiet-san-pham/{idsp}', [PostController::class, 'baivietchitietsp']);
