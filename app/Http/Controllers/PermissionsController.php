<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Permissions;

class PermissionsController extends Controller
{
     public function getRoutes($id)
     {
          $permissions = new Permissions(); // Tạo một đối tượng của lớp Permissions
          $routes = $permissions->getActiveRoutes($id);
          return response()->json($routes); // Trả về dữ liệu JSON
     }

}
