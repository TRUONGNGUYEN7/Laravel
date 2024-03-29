<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminAccountRequest;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;
use App\Models\Functionality;
use App\Models\Routes;
use App\Models\Roles;
use App\Models\GroupPermission;
use App\Models\RoleAdmin;

class AdminController extends Controller
{

    public function error(){
        return view('admin.pages.error');
    }

    public function showhome(){
        return view('admin.pages.home');
    }

    public function getAccounts(Request $request){
        $ds = Admin::paginate(5)->fragment('ds');
        $dsroles = Roles::getActiveRoles();
        return view('admin.taikhoan.lietke')->with('ds', $ds)->with('dsroles', $dsroles);
    }

    public function store(AdminAccountRequest $request)
    {
        $data = [
            'Name' => $request->Name,
            'Hoten' => $request->Hoten,
            'MatKhau' => Hash::make($request->MatKhau),
            'Email' => $request->Email,
            'roleID' => $request->roleID,
            'TrangThai' => 1 // Đặt TrangThai mặc định là 1
        ];
        // Tạo tài khoản mới
        $account = Admin::create($data);

        // Lấy ID của bản ghi vừa tạo
        $newlyCreatedId = $account->IDAD;
        // Data for RoleAdmin
        $roleAdminData = [
            'roleID' => $request->roleID,
            'adminID' => $newlyCreatedId,
        ];
        // Create new entry in roleadmin table
        RoleAdmin::create($roleAdminData);

        // Phản hồi về thành công hoặc thất bại
        if ($account) {
            return response()->json(['success' => true, 'message' => 'Thêm tài khoản thành công'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Thêm tài khoản thất bại'], 500);
        }
    }

    public function login(){
        return view('admin.pages.login');
    }

    public function loginaction(AdminLoginRequest $request)
    {
        $adminname = $request->adminname;
        $adminpass = $request->adminpass;

        $authenticatedAdmin = Admin::Authenticate($adminname, $adminpass);

        if ($authenticatedAdmin) {
            if ($authenticatedAdmin->TrangThai == 0) {
                Session::flash('message', 'Bạn chưa có quyền đăng nhập!!!');
                return back();
            } else {
                $adminData = [
                    'admin_username' => $authenticatedAdmin->Hoten,
                    'admin_id' => $authenticatedAdmin->IDAD,
                    'admin_name' => $authenticatedAdmin->Name,
                ];
                Session::put('admin_data', $adminData);
                return redirect()->to('/admin/index');
            }
        } else {
            $request->session()->flash('message', 'Tài khoản hoặc mật khẩu của bạn không đúng, vui lòng thử lại!!!');
            return redirect()->to('/admin/login');
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Name' => 'required|string',
            'Hoten' => 'required|string',
            'Email' => 'required|email',
            'MatKhau' => 'required|string',
            'roleID' => 'required',
            'TrangThai' => 'required'
        ]);

        $admin = new Admin();
        $admin->updateAccount($id, $validatedData);

        // Data for RoleAdmin
        $roleAdminData = [
            'roleID' => $request->roleID,
            'adminID' => $id, // Assuming $id contains the admin ID you want to associate
        ];

        // Update role_admin khi cập nhật vai trò tài khoản
        RoleAdmin::updateOrCreate(['adminID' => $id], $roleAdminData);

        if($admin){
            return response()->json(['success' => true, 'message' => 'Sửa tài khoản thành công'], 200);
        }else{
            return response()->json(['success' => false, 'message' => 'Sửa tài khoản thất bại'], 500);
        }
    }

    public function status($id)
    {
        $value = Admin::changeStatusAdmin($id);
        return response()->json(['status' => $value]);
    }

    public function destroy($id)
    {
        Admin::deleteAdminById($id);
        return back();
    }

    public function getaccountByID($id)
    {
        $admin = Admin::getaccountByID($id);
        return response()->json($admin);
    }

    public function logout(){
        Session::forget('admin_data');
        return redirect('/admin');
    }

}
