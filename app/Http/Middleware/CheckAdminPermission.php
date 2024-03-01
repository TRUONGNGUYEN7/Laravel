<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\Route;

class CheckAdminPermission
{
    public function handle($request, Closure $next)
    {
        
        $adminData = session('admin_data');

        $adminName = $adminData['admin_name'];

        // Kiểm tra nếu tên admin là 'admin', cho phép luôn
        if ($adminName === 'admin') {
            return $next($request);
        }

        // Lấy id của admin
        $adminId = $adminData['admin_id'];
    
        // Tìm roleid trong bảng admin
        $admin = Admin::findOrFail($adminId);
        $roleId = $admin->roleID;

        // Lấy route hiện tại
        $currentRouteName = Route::currentRouteName();
        // dd($currentRouteName);
        // Kiểm tra xem route hiện tại có tồn tại trong bảng permission_role không
        $permission = PermissionRole::where('roleID', $roleId)
                                    ->whereHas('permissions', function ($query) use ($currentRouteName) {
                                        $query->where('name', $currentRouteName);
                                    })
                                    ->exists();

        if ($permission) {
            return $next($request);
        } else {
            return redirect()->route('admin.error');
        }
    }
}
