<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth as Auth;
class Authenticate
{
    public function handle($request, Closure $next)
    {
        // Kiểm tra xem người dùng có được xác thực bởi guard 'admin' hay không
        if (Auth::guard('user')->check()) {
            // Nếu có, lấy thông tin người dùng quản trị
            $admin = Auth::guard('user')->user();
            return $next($request);
        }

        // Nếu không xác thực, chuyển hướng người dùng đến trang đăng nhập cho quản trị viên
        return redirect()->route('auth/signin');
    }
}
