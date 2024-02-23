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

    public static function getRoles() {
        return self::all();
    }

    public static function updateDataroute($id, $dataroute)
    {
        // Tìm và cập nhật dữ liệu dataroute tại ID cụ thể
        self::where('id', $id)->update(['dataroute' => $dataroute]);
    }

    public static function checkAndCreateRoles($request)
    {
        $Rolesname = $request->tennhomquyen;
        $roleCheck = self::where('Role_name', $Rolesname)->first();

        if ($roleCheck) {
            Session::flash('message', 'Danh mục đã tồn tại!');
        } else {
            $Roles = new self();
            $Roles->Role_name = $Rolesname;
            $Roles->Dataroute = '';
            $Roles->save();
            Session::flash('message', 'Thêm thành công!');
        }

    }
}
