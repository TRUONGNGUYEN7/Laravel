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

    // Admin Danhmuc
    $danhmucRoute = 'danhmuc';
    Route::resource($danhmucRoute, $categoryController)->names([
        'index' => "$adminRoutePrefix.$danhmucRoute.index",
        'create' => "$adminRoutePrefix.$danhmucRoute.create",
        'store' => "$adminRoutePrefix.$danhmucRoute.store",
    ]);
    Route::get("/$danhmucRoute/sua/{id}", [$categoryController, 'sua'])->name("$adminRoutePrefix.$danhmucRoute.sua");
    Route::post("/$danhmucRoute/action_sua/{id}", [$categoryController, 'action_sua'])->name("$adminRoutePrefix.$danhmucRoute.action_sua");
    Route::post("/$danhmucRoute/xoa/{id}", [$categoryController, 'xoa'])->name("$adminRoutePrefix.$danhmucRoute.xoa");
    Route::get("/$danhmucRoute/status/{id}/{value}", [$categoryController, 'status'])->name("$adminRoutePrefix.$danhmucRoute.status");

    // Admin Chude
    $chudeRoute = 'chude';
    Route::resource($chudeRoute, $subcategoryController)->names([
        'index' => "$adminRoutePrefix.$chudeRoute.index",
        'create' => "$adminRoutePrefix.$chudeRoute.create",
        'store' => "$adminRoutePrefix.$chudeRoute.store",
    ]);
    Route::get("/$chudeRoute/sua/{id}", [$subcategoryController, 'sua'])->name("$adminRoutePrefix.$chudeRoute.sua");
    Route::post("/$chudeRoute/action_sua/{id}", [$subcategoryController, 'action_sua'])->name("$adminRoutePrefix.$chudeRoute.action_sua");
    Route::post("/$chudeRoute/xoa/{id}", [$subcategoryController, 'xoa'])->name("$adminRoutePrefix.$chudeRoute.xoa");
    Route::get("/$chudeRoute/status/{id}/{value}", [$subcategoryController, 'status'])->name("$adminRoutePrefix.$chudeRoute.status");

    // Admin Baiviet
    $baivietRoute = 'baiviet';
    Route::resource($baivietRoute, $postController)->names([
        'index' => "$adminRoutePrefix.$baivietRoute.index",
        'create' => "$adminRoutePrefix.$baivietRoute.create",
        'store' => "$adminRoutePrefix.$baivietRoute.store",
    ]);
    Route::get("/$baivietRoute/sua/{id}", [$postController, 'sua'])->name("$adminRoutePrefix.$baivietRoute.sua");
    Route::post("/$baivietRoute/action_sua/{id}", [$postController, 'action_sua'])->name("$adminRoutePrefix.$baivietRoute.action_sua");
    Route::post("/$baivietRoute/xoa/{id}", [$postController, 'xoa'])->name("$adminRoutePrefix.$baivietRoute.xoa");
    Route::get("/$baivietRoute/status/{id}/{value}", [$postController, 'status'])->name("$adminRoutePrefix.$baivietRoute.status");
});
