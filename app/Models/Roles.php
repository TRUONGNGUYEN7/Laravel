<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Roles extends Model
{
    use HasFactory;
    // Khai báo tên bảng
    protected $table = 'roles';

    // Khai báo tên cột primary key và sử dụng auto-increment
    protected $primaryKey = 'id';

    // Khai báo các cột có thể gán giá trị
    protected $fillable = [
        'id',
        'name',
        'displayName',
    ];

    public static function getRoles()
    {
        return self::all(); // Trả về danh sách các vai trò
    }

    public static function getActiveRoles()
    {
        return self::where('status', 1)->get();
    }
    public static function updateRoleName($id, $newName)
    {
        // Tìm và cập nhật tên của vai trò
        $role = self::find($id);

        if ($role) {
            $role->name = $newName;
            $role->save();
        }
    }

    public static function checkAndCreateRoles($request)
    {
        $Rolesname = $request->tennhomquyen;
        $roleCheck = self::where('name', $Rolesname)->first();

        if ($roleCheck) {
            return false; // Trả về false nếu nhóm quyền đã tồn tại
        } else {
            $Roles = new self();
            $Roles->name = $Rolesname;
            $Roles->status = 1;
            $Roles->save();
            return true; // Trả về true nếu nhóm quyền được tạo thành công
        }
    }

    public static function UpdateRoles($request, $id)
    {
        $Rolesname = $request->tennhomquyensua;
    
        // Kiểm tra xem tên vai trò mới có tồn tại trong CSDL không
        $kiemTraTonTai = Roles::where('name', $Rolesname)
            ->where('id', '<>', $id)
            ->exists();
    
        if ($kiemTraTonTai) {
            // Nếu tên đã tồn tại, thông báo lỗi
            Session::flash('message', 'Tên danh mục đã tồn tại!!!');
        } else {
            // Nếu không tồn tại, cập nhật vai trò
            $Roles = Roles::findOrFail($id); // Tìm vai trò theo ID
            $Roles->name = $Rolesname; // Cập nhật tên mới
            $Roles->status = 1; // Đặt trạng thái (nếu cần)
            $Roles->save(); // Lưu thay đổi
            Session::flash('message', 'Cập nhật thành công!');
        }
    }

    // Hàm xóa vai trò dựa trên id
    public static function deleteRole($id)
    {
        return Roles::where('id', $id)->delete();
    }
}
