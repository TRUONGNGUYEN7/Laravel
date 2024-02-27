<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use App\Models\Functionality;
use App\Models\Routes;
use App\Models\Roles;
use App\Models\GroupPermission;

class RolesController extends Controller
{
    // public function index()
    // {
    //     $dschucnang = Functionality::getActiveFunction();
    //     $dsvaitro = Roles::getRoles();
    //     return view('admin.nhomquyen.them')->with('dschucnang', $dschucnang)->with('dsvaitro', $dsvaitro);
    // }
    //     // nhomquyen
    public function index()
    {
        $dsgrouppermission = GroupPermission::getActiveGroupPermission();
        $dsvaitro = Roles::getRoles();
        return view('admin.nhomquyen.them')->with('dsgrouppermission', $dsgrouppermission)->with('dsvaitro', $dsvaitro);
    }
    
    public function store(Request $request)
    {
        $result = Roles::checkAndCreateRoles($request);

        if ($result === true) {
            return response()->json(['success' => true, 'message' => 'Thêm nhóm quyền thành công']);
        } else {
            return response()->json(['success' => false, 'message' => 'Danh mục đã tồn tại']);
        }
    }


    public function update(Request $request, $id)
    {
        // Validate dữ liệu nếu cần
        $request->validate([
            'tennhomquyensua' => 'required|string|max:255', // Ví dụ: Yêu cầu tên mới là một chuỗi có độ dài tối đa 255 ký tự
        ]);

        // Lấy tên mới của vai trò từ request
        $newName = $request->tennhomquyensua;

        // Gọi phương thức updateRoleName từ model Role để cập nhật tên của vai trò
        Roles::updateRoleName($id, $newName);

        // Phản hồi về thành công hoặc bất kỳ thông báo nào khác nếu cần
        return response()->json(['success' => true, 'message' => 'Cập nhật tên vai trò thành công']);
        
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
