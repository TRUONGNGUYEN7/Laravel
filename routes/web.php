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
//Homeuser
Route::prefix('/')->group(function () {
     Route::get('/', [Homecontroller::class, 'index']);
     Route::get('/trangchu', [Homecontroller::class, 'index']);
});

//User-danhmuc
Route::prefix('/user')->group(function () {
     Route::get('/danhmuc/{id}', [Homecontroller::class, 'hienthidanhmuc'])->name('admin.hienthidanhmuc');
     Route::get('/chude/{id}/{iddm}', [Homecontroller::class, 'hienthichude'])->name('admin.hienthichude');
});

Route::prefix('/admin')->group(function () {
     Route::get('/', [AdminController::class, 'login']);
     Route::get('/login', [AdminController::class, 'login']);
     Route::post('/loginaction', [AdminController::class, 'loginaction']);
     Route::get('/logout', [AdminController::class, 'logout']);
});

//Admin
$adminController = AdminController::class;
$categoryController = CategoryController::class;
$subcategoryController = SubcategoryController::class;
$postController = PostController::class;

$adminRoutePrefix = 'admin';
Route::group(['prefix' => "/$adminRoutePrefix", 'middleware' => 'checkadminlogin'], function () use ($adminRoutePrefix, $adminController, $categoryController, $subcategoryController, $postController) {
    Route::get('/index', [$adminController, 'showhome'])->name("$adminRoutePrefix.showhome");

    $adminRoutePrefix = 'admin';

    // Admin Danhmuc
    $danhmucRoute = 'danhmuc';
    Route::resource("$danhmucRoute", "$categoryController")->names([
        'index' => "$adminRoutePrefix.$danhmucRoute.index",
        'create' => "$adminRoutePrefix.$danhmucRoute.create",
        'store' => "$adminRoutePrefix.$danhmucRoute.store",
        'edit' => "$adminRoutePrefix.$danhmucRoute.sua",
        'update' => "$adminRoutePrefix.$danhmucRoute.action_sua",
        'destroy' => "$adminRoutePrefix.$danhmucRoute.xoa",
    ]);
    Route::get("/$danhmucRoute/status/{id}/{value}", "$categoryController@status")->name("$adminRoutePrefix.$danhmucRoute.status");
    
    // Admin Chude
    $chudeRoute = 'chude';
    Route::resource("$chudeRoute", "$subcategoryController")->names([
        'index' => "$adminRoutePrefix.$chudeRoute.index",
        'create' => "$adminRoutePrefix.$chudeRoute.create",
        'store' => "$adminRoutePrefix.$chudeRoute.store",
        'edit' => "$adminRoutePrefix.$chudeRoute.sua",
        'update' => "$adminRoutePrefix.$chudeRoute.action_sua",
        'destroy' => "$adminRoutePrefix.$chudeRoute.xoa",
    ]);
    Route::get("/$chudeRoute/status/{id}/{value}", "$subcategoryController@status")->name("$adminRoutePrefix.$chudeRoute.status");
    
    // Admin Baiviet
    $baivietRoute = 'baiviet';
    Route::resource("$baivietRoute", "$postController")->names([
        'index' => "$adminRoutePrefix.$baivietRoute.index",
        'create' => "$adminRoutePrefix.$baivietRoute.create",
        'store' => "$adminRoutePrefix.$baivietRoute.store",
        'edit' => "$adminRoutePrefix.$baivietRoute.sua",
        'update' => "$adminRoutePrefix.$baivietRoute.action_sua",
        'destroy' => "$adminRoutePrefix.$baivietRoute.xoa",
    ]);
    Route::get("/$baivietRoute/status/{id}/{value}", "$postController@status")->name("$adminRoutePrefix.$baivietRoute.status");
    
});
