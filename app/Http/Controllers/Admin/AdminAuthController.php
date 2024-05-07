<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminModel;
use App\Http\Requests\AuthLoginRequest as MainRequest;
use Illuminate\Support\Facades\Auth as Auth;

class AdminAuthController extends Controller
{
    private $pathViewController = 'admin.pages.auth.';
    private $controllerName     = 'adminAuth';
    private $moduleName     = 'admin';
    private $params             = [];
    private $model;

    public function __construct()
    {
        view()->share([
            'moduleName'     => $this->moduleName,
            'controllerName' => $this->controllerName
        ]);
    }

    public function login()
    {
        return view($this->pathViewController .  'login', []);
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('name', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
                $admin = Auth::guard('admin')->user();
            if ($admin->status == 'inactive') {
                return back()->with('message', 'Bạn chưa có quyền đăng nhập!!!');
            } else {
                return view('admin.pages.dashboard.index');
            }  
        }else{
            return redirect()->route('adminAuth/login')->with('message', 'Tài khoản hoặc mật khẩu không chính xác!')->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return view($this->pathViewController .  'login', []);
    }
}
