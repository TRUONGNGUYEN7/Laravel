<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PermissionRole;
use App\Models\Roles;
use App\Http\Requests\RolesCreateRequest;
use App\Models\GroupPermission;
use Illuminate\Support\Facades\Validator;

class PermissionRoleController extends Controller
{

    public function index()
    {
        $dsgrouppermission = GroupPermission::getActiveGroupPermission();
        $dsvaitro = Roles::getRoles();
        return view('admin.nhomquyen.them')->with('dsgrouppermission', $dsgrouppermission)->with('dsvaitro', $dsvaitro);
    }

    public function addPermissionRole(Request $request)
    {
        $selectedActions = $request->selectedActions;
        $Status = $request->Status;

        // Gọi hàm checkAndCreateRoles và truyền request vào
        $resultaddrole = Roles::checkAndCreateRoles($request);
        if ($resultaddrole !== false) {
            //Get lại id vừa thêm sau đó addpermissionrole từ idrole
            PermissionRole::addPermissionRole($resultaddrole, $selectedActions, $Status);
            return response()->json(['message' => 'Thêm thành công']);
        }
    }

    public function updatePermissionRole(Request $request, $id)
    {
        $selectedActions = $request->selectedActions;
        PermissionRole::updatePermissionRole($id, $selectedActions);
        return response()->json(['message' => 'Cập nhật thành công']);
    }

    public function getRoutesPermissionByID($id)
    {
        $permissions = new PermissionRole(); // Tạo một đối tượng của lớp Permissions
        $routes = $permissions->getRoutesPermission($id);
        return response()->json($routes); // Trả về dữ liệu JSON
    }
}
