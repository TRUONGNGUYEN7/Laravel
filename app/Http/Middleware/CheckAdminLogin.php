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

        $adminData = Session::get('admin_data');

        if ($adminData) {
            return $next($request);
        } else {
            return redirect("/admin/login");
        }
    }
}