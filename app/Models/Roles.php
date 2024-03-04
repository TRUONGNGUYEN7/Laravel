<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use App\Models\Permissions;
use App\Models\Admin;

class Roles extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'status',
    ];

    //mot vai tro co nhieu admin
    public function admins()
    {
        return $this->hasMany(Admin::class, 'roleID', 'id');
    }

    public static function getRoles()
    {
        return self::where('name', '!=', 'admin')->get();
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
        $Roles = new self();
        $Roles->name = $Rolesname;
        $Roles->status = 1;
        $Roles->save();
        return $Roles->id;
    }

    public static function updateRoles($request, $id)
    {
        $Rolesname = $request->tenvaitro;
        $Roles = self::findOrFail($id); // Tìm vai trò theo ID
        $Roles->name = $Rolesname; // Cập nhật tên mới
        $Roles->status = 1; // Đặt trạng thái (nếu cần)
        $Roles->save(); // Lưu thay đổi
    }

    // Hàm xóa vai trò dựa trên id
    public static function deleteRole($id)
    {
        return self::where('id', $id)->delete();
    }
}
