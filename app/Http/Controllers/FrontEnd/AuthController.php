<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthLoginRequest as MainRequest;
use Illuminate\Support\Facades\Auth as Auth;
use App\Models\UserModel;

class AuthController extends Controller
{
    private $pathViewController = 'user.pages.auth.';
    private $controllerName     = 'auth';
    private $params             = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function login()
    {
        return view($this->pathViewController .  'login', []);
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('auth/login')->with('ntg_notify_error', 'Tài khoản hoặc mật khẩu không chính xác!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route($this->controllerName.'/login');
    }
}
