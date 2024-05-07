<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use App\Models\Functionality;
use App\Models\Routes;
use App\Models\Roles;
use App\Models\GroupPermission;
use App\Http\Requests\RolesUpdateRequest;
use App\Http\Requests\RolesCreateRequest;

class RolesController extends Controller
{

    public function store(RolesCreateRequest $request)
    {
        $result = Roles::checkAndCreateRoles($request);

        if ($result === true) {
            return response()->json(['success' => true, 'message' => 'Thêm nhóm quyền thành công']);
        } else {
            return response()->json(['success' => false, 'message' => 'Danh mục đã tồn tại']);
        }
    }
    public function update(RolesUpdateRequest $request, $id)
    {
        // Kiểm tra xem request đã được validate chưa
        if ($request->validated()) {
            // Gọi phương thức updateRoles từ model để cập nhật vai trò
            Roles::updateRoles($request, $id);
            
            // Trả về response JSON thông báo thành công
            return response()->json(['message' => 'Cập nhật thành công']);
        }
    }

    public function get(Request $request)
    {
        $roles = Roles::getRoles(); // Gọi hàm getRoles từ model Roles
        return response()->json($roles); // Trả về kết quả dưới dạng JSON
    }

    public function updateDataroute(Request $request, $id)
    {
        $jsonData = $request->json()->all();
        $dataroute = $jsonData['selectedActions'];
        Roles::updateDataroute($id, $dataroute);
        return response()->json(['message' => 'Dữ liệu đã được cập nhật thành công'], 200);
    }

    // Hàm xóa vai trò
    public function destroy($id)
    {
        // Gọi hàm xóa từ model Role
        $result = Roles::deleteRole($id);

        if ($result) {
            // Nếu xóa thành công, redirect hoặc trả về thông báo thành công
            return redirect()->back()->with('success', 'Xóa vai trò thành công');
        } else {
            // Nếu xóa không thành công, redirect hoặc trả về thông báo lỗi
            return redirect()->back()->with('error', 'Xóa vai trò không thành công');
        }
    }

}
