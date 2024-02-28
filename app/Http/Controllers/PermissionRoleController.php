<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermissionRole;
use App\Models\Roles;

class PermissionRoleController extends Controller
{
    public function updatePermissionRole(Request $request, $id)
    {
        $selectedActions = $request->selectedActions;
        PermissionRole::updatePermissionRole($id, $selectedActions);
        return response()->json(['message' => 'Cập nhật thành công']);
    }

    public function addPermissionRole(Request $request)
    {
        $selectedActions = $request->selectedActions;
        $tennhomquyen = $request->tennhomquyen;
        $Status = $request->Status;
        // Gọi hàm checkAndCreateRoles và truyền tên nhóm quyền từ request vào
        $resultaddrole = Roles::checkAndCreateRoles($request);

        if ($resultaddrole !== false) {
            //Get lại id vừa thêm sau đó addpermissionrole từ idrole
            PermissionRole::addPermissionRole($resultaddrole, $selectedActions, $Status);
            return response()->json(['message' => 'Cập nhật thành công']);
        } else {
            return response()->json(['message' => 'Tên vai trò đã tồn tại']);
        }
    }

    public function getRoutesPermissionByID($id)
    {
        $permissions = new PermissionRole(); // Tạo một đối tượng của lớp Permissions
        $routes = $permissions->getRoutesPermission($id);
        return response()->json($routes); // Trả về dữ liệu JSON
    }
}
