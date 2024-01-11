<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CheckAdminLogin
{
    public function handle($request, Closure $next)
    {
        $admin_username = Session::get('admin_username');
        if ($admin_username) {
            return $next($request);
        } else {
            return redirect("/admin/login");
        }
    }
}
