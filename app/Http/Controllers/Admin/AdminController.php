<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminAccountRequest;
use Illuminate\Support\Facades\Hash;

use App\Models\AdminModel;
use App\Models\Functionality;
use App\Models\Routes;
use App\Models\Roles;
use App\Models\GroupPermission;
use App\Models\RoleAdmin;
use App\Http\Controllers\Admin\BaseController;

use Illuminate\Support\Facades\Auth;

class AdminController extends BaseController
{

    public function __construct()
    {
        $this->controllerName     = 'dashboard';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";

        view()->share([
            'moduleName'     => $this->moduleName,
            'controllerName' => $this->controllerName,
            'pageTitle'=> $this->pageTitle
        ]);
    }

    public function index(){
        return view($this->pathViewController .  'index', []);
    }

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

    public function loginform(){
        return view($this->moduleName.'.pages.auth.login', []);
    }

    public function login(AdminLoginRequest $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();

            if ($user->status == 'inactive') {
                return back()->with('message', 'Bạn chưa có quyền đăng nhập!!!');
            } else {
                return redirect()->route('admin.index');
            }
        } else {
            return back()->with('message', 'Tài khoản hoặc mật khẩu của bạn không đúng, vui lòng thử lại!!!');
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

}
