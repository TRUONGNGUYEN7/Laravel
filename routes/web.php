<?php

$prefixAdmin = config('ntg.url.prefix_admin');
$prefixFrontEnd  = config('ntg.url.prefix_frontEnd');

$prefix = '';
$controllerName = 'Admin\Post';
$controller = ucfirst($controllerName) . 'Controller@';
Route::get($prefix . 'displayimg/{fileName}', [ 'as' => 'displayImages', 'uses' => $controller . 'displayImage' ]);

Route::group(['prefix' => $prefixAdmin, 'namespace' => 'Admin','middleware' => ['authAdmin']], function () {
    // ============================== DASHBOARD ==============================
    $prefix         = '';
    $controllerName = 'admin';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/', [ 'as' => $controllerName .'.index' , 'uses' => $controller . 'index' ]);
    });
    // ============================== HUYEN ==============================
    $prefix         = 'danhmuc';
    $controllerName = 'category';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route:: get('/',                             [ 'as' => $controllerName,                  'uses' => $controller . 'index' ]);
        Route:: get('form/{id?}',                    [ 'as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route:: post('save',                         [ 'as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route:: get('delete/{id}',                   [ 'as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route:: get('change-status-{status}/{id}',   [ 'as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    });

    // ============================== Sub ==============================
    $prefix         = 'chude';
    $controllerName = 'subcategory';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route:: get('/',                             [ 'as' => $controllerName,                  'uses' => $controller . 'index' ]);
        Route:: get('form/{id?}',                    [ 'as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route:: post('save',                         [ 'as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route:: get('delete/{id}',                   [ 'as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route:: get('change-status-{status}/{id}',   [ 'as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    });

    // ============================== Post ==============================
    $prefix         = 'baiviet';
    $controllerName = 'post';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route:: get('/',                             [ 'as' => $controllerName,                  'uses' => $controller . 'index' ]);
        Route:: get('form/{id?}',                    [ 'as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route:: post('save',                         [ 'as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route:: get('delete/{id}',                   [ 'as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route:: get('change-status-{status}/{id}',   [ 'as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    });

});

Route::group(['prefix' => $prefixAdmin, 'namespace' => 'Admin'], function () {
    // ====================== LOGIN ========================
    $prefix         = '';
    $controllerName = 'adminAuth';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/login',        ['as' => $controllerName.'/login',      'uses' => $controller . 'login']);
        Route::post('/postLogin',   ['as' => $controllerName.'/postLogin',  'uses' => $controller . 'postLogin']);

        // ====================== LOGOUT ========================
        Route::get('/logout',       ['as' => $controllerName.'/logout',     'uses' => $controller . 'logout']);
    });
});


Route::group(['prefix' => $prefixFrontEnd, 'namespace' => 'User'], function () {
    // ============================== DASHBOARD ==============================
    $prefix         = '';
    $controllerName = 'user';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/', [ 'as' => $controllerName .'/index' , 'uses' => $controller . 'index' ]);
    });

});
Route::group(['prefix' => $prefixFrontEnd, 'namespace' => 'User'], function () {
    // ====================== LOGIN ========================
    $prefix         = '';
    $controllerName = 'user';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('baiviet/detail/{id}', ['as' => $controllerName.'/detail',      'uses' => $controller . 'detail']);
        Route::get('view/{id}/{iddm?}', ['as' => $controllerName.'/view',      'uses' => $controller . 'view']);
    });

    $prefix         = '';
    $controllerName = 'auth';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/signin',        ['as' => $controllerName.'/signin',      'uses' => $controller . 'signin']);
        Route::post('/signin_action',   ['as' => $controllerName.'/signin_action',  'uses' => $controller . 'signin_action']);
        Route::get('/signup',       ['as' => $controllerName.'/signup',     'uses' => $controller . 'signup']);
        Route::post('/signup_action',   ['as' => $controllerName.'/signup_action',  'uses' => $controller . 'signup_action']);

        // ====================== LOGOUT ========================
        Route::get('/logout',       ['as' => $controllerName.'/logout',     'uses' => $controller . 'logout']);
    });

    $prefix         = '';
    $controllerName = 'comment';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/comment', [ 'as' => $controllerName .'/add' , 'uses' => $controller . 'add' ]);
    });

});
// //Homeuser
// Route::prefix('/')->group(function () {
//      Route::get('/index', [HomeController::class, 'index'])->name('user.home');
// });

// $CommentController = 'App\Http\Controllers\CommentController';
// $user = 'user';
// Route::prefix('user')->group(function () use ($CommentController, $user) {
//      Route::post('add/{id}', [$CommentController, 'addcomment'])->name("$user.comment.add");
// });

// $userController = 'App\Http\Controllers\UserController';
// $user = 'user'; 
// Route::prefix('user')->group(function () use ($userController, $user) {
//      Route::get('baiviet/detail/{id}', [$userController, 'detail'])->name("$user.baiviet.detail");
//      Route::get('submenu/{id}/{iddm?}', [$userController, 'hienthi'])->name("$user.hienthi");
//      Route::get('signup', [$userController, 'signup'])->name("$user.signup");
//      Route::post('signup_action', [$userController, 'signup_action'])->name("$user.signup_action");
//      Route::get('signin', [$userController, 'signin'])->name("$user.signin");
//      Route::post('signin_action', [$userController, 'signin_action'])->name("$user.signin_action");
//      Route::get('logout', [$userController, 'logout'])->name("$user.logout");
// });

// // $authController = 'App\Http\Controllers\AuthController';
// // Route::get('/login', [$authController, 'showLoginForm']);
// // Route::post('/login', [$authController, 'login'])->name('login');
// // Route::post('/logout', [$authController, 'logout'])->name('logout');



// //Admin
// Route::group(['prefix' => "$adminRoutePrefix", 'middleware' => 'checkadminlogin'], function () use ($adminRoutePrefix) {

//      $adminController = 'App\Http\Controllers\AdminController';
//      Route::get('index', [$adminController, 'index'])->name("$adminRoutePrefix.index");

//      $accounts = 'accounts';
//      Route::group(['middleware' => 'checkadminpermission'], function () use ($accounts, $adminController, $adminRoutePrefix) {
//           Route::get("$accounts/get", [$adminController, 'getAccounts'])->name("$adminRoutePrefix.$accounts.get");
//           Route::post("$accounts/store", [$adminController, 'store'])->name("$adminRoutePrefix.$accounts.store");
//           Route::get("$accounts/{id}/edit", [$adminController, 'edit'])->name("$adminRoutePrefix.$accounts.sua");
//           Route::put("$accounts/update/{id}", [$adminController, 'update'])->name("$adminRoutePrefix.$accounts.update");
//           Route::post("$accounts/xoa/{id}", [$adminController, 'destroy'])->name("$adminRoutePrefix.$accounts.xoa");
//           Route::get("$accounts/status/{id}", [$adminController, 'status'])->name("$adminRoutePrefix.$accounts.status");
//           Route::get("$accounts/getaccountByID/{id}", [$adminController, 'getaccountByID'])->name("$adminRoutePrefix.$accounts.getaccountByID");
//      });

//      $vaitroRoute = 'vaitro';
//      $vaitroController = 'App\Http\Controllers\RolesController';
//      Route::group(['middleware' => 'checkadminpermission'], function () use ($vaitroRoute, $vaitroController, $adminRoutePrefix) {
//           Route::post("$vaitroRoute", [$vaitroController, 'store'])->name("$adminRoutePrefix.$vaitroRoute.store");
//           Route::get("$vaitroRoute/{id}/edit", [$vaitroController, 'edit'])->name("$adminRoutePrefix.$vaitroRoute.sua");
//           Route::put("$vaitroRoute/update/{id}", [$vaitroController, 'update'])->name("$adminRoutePrefix.$vaitroRoute.update");
//           Route::post("$vaitroRoute/{id}", [$vaitroController, 'destroy'])->name("$adminRoutePrefix.$vaitroRoute.xoa");
//           Route::get("$vaitroRoute/status/{id}", [$vaitroController, 'status'])->name("$adminRoutePrefix.$vaitroRoute.status");
//           Route::post("$vaitroRoute/updateDataroute/{id}", [$vaitroController, 'updateDataroute'])->name("$adminRoutePrefix.$vaitroRoute.update-dataroute");
//           Route::get("$vaitroRoute/get", [$vaitroController, 'get'])->name("$adminRoutePrefix.$vaitroRoute.get");
//      });

//      $permissions = 'permissions';
//      $permissionsController = 'App\Http\Controllers\PermissionsController';
//      Route::get('$permissions/get/{id}', [$permissionsController, 'getRoutes'])->name("$adminRoutePrefix.$permissions.getRoutes");

//      $permissionRole = 'permissionRole';
//      $permissionRoleController = 'App\Http\Controllers\PermissionRoleController';
//      Route::get('$permissionRole', [$permissionRoleController, 'index'])->name("$adminRoutePrefix.$permissionRole.index");
//      Route::post('$permissionRole/addPermissionRole', [$permissionRoleController, 'addPermissionRole'])->name("$adminRoutePrefix.$permissionRole.addPermissionRole");
//      Route::post('$permissionRole/updatePermissionRole/{id}', [$permissionRoleController, 'updatePermissionRole'])->name("$adminRoutePrefix.$permissionRole.updatePermissionRole");
//      Route::get('$permissionRole/getRoutesPermissionByID/{id}', [$permissionRoleController, 'getRoutesPermissionByID'])->name("$adminRoutePrefix.$permissionRole.getRoutesPermissionByID");

//      $danhmucRoute = 'danhmuc';
//      $categoryController = 'App\Http\Controllers\CategoryController';
//      Route::group(['middleware' => 'checkadminpermission'], function () use ($danhmucRoute, $categoryController, $adminRoutePrefix) {
//           Route::get("$danhmucRoute/status/{id}", [$categoryController, 'status'])->name("$adminRoutePrefix.$danhmucRoute.status");

//           Route::get("$danhmucRoute/index", [$categoryController, 'index'])->name("$adminRoutePrefix.$danhmucRoute.index");
//           Route::get("$danhmucRoute/list", [$categoryController, 'list'])->name("$adminRoutePrefix.$danhmucRoute.list");
//           Route::match(['get', 'post'], "$danhmucRoute/form/{id?}", [$categoryController, 'form'])->name("$adminRoutePrefix.$danhmucRoute.form");
//           Route::post("$danhmucRoute/save/{id?}", [$categoryController, 'save'])->name("$adminRoutePrefix.$danhmucRoute.save");
//           Route::post("$danhmucRoute/delete/{id?}", [$categoryController, 'destroy'])->name("$adminRoutePrefix.$danhmucRoute.delete");

//      });

//      $chudeRoute = 'chude';
//      $subcategoryController = 'App\Http\Controllers\SubcategoryController';
//      Route::group(['middleware' => 'checkadminpermission'], function () use ($chudeRoute, $subcategoryController, $adminRoutePrefix) {
//           Route::get("$chudeRoute/status/{id}", [$subcategoryController, 'status'])->name("$adminRoutePrefix.$chudeRoute.status");

//           Route::get("$chudeRoute/index", [$subcategoryController, 'index'])->name("$adminRoutePrefix.$chudeRoute.index");
//           Route::get("$chudeRoute/list", [$subcategoryController, 'list'])->name("$adminRoutePrefix.$chudeRoute.list");
//           Route::match(['get', 'post'], "$chudeRoute/form/{id?}", [$subcategoryController, 'form'])->name("$adminRoutePrefix.$chudeRoute.form");
//           Route::post("$chudeRoute/save/{id?}", [$subcategoryController, 'save'])->name("$adminRoutePrefix.$chudeRoute.save");
//           Route::post("$chudeRoute/delete/{id?}", [$subcategoryController, 'destroy'])->name("$adminRoutePrefix.$chudeRoute.delete");
//      });

//      $baivietRoute = 'baiviet';
//      $postController = 'App\Http\Controllers\PostController';
//      Route::group(['middleware' => 'checkadminpermission'], function () use ($baivietRoute, $postController, $adminRoutePrefix) {
//           Route::get("$adminRoutePrefix/status/{id}", [$postController, 'status'])->name("$adminRoutePrefix.$baivietRoute.status");

//           Route::get("$baivietRoute/index", [$postController, 'index'])->name("$adminRoutePrefix.$baivietRoute.index");
//           Route::get("$baivietRoute/list", [$postController, 'list'])->name("$adminRoutePrefix.$baivietRoute.list");
//           Route::match(['get', 'post'], "$baivietRoute/form/{id?}", [$postController, 'form'])->name("$adminRoutePrefix.$baivietRoute.form");
//           Route::post("$baivietRoute/save/{id?}", [$postController, 'save'])->name("$adminRoutePrefix.$baivietRoute.save");
//           Route::post("$baivietRoute/delete/{id?}", [$postController, 'destroy'])->name("$adminRoutePrefix.$baivietRoute.delete");
//      });

// });
