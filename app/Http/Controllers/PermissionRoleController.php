<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermissionRole;

class PermissionRoleController extends Controller
{
    public function updatePermissionRole(Request $request, $id)
    {
        $selectedActions = $request->selectedActions;
        PermissionRole::updatePermissionRole($id, $selectedActions);
        return response()->json(['message' => 'Cập nhật thành công']);
    }
}
