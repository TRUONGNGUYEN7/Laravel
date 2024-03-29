<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Roles;

class Admin extends Model
{
    protected $table = 'tbladmin';
    protected $primaryKey = 'IDAD';
    protected $fillable = [
        'IDAD', 'Name', 'Hoten', 'Email', 'MatKhau', 'roleID', 'TrangThai'
    ];

    //mot admin có 1 vai tro
    public function roles()
    {
        return $this->belongsTo(Roles::class, 'roleID', 'id');
    }

    public static function Authenticate($adminname, $adminpass)
    {
        $admin = self::where('Name', $adminname)->first(); 
        if ($admin && Hash::check($adminpass, $admin->MatKhau)) {
            return $admin;
        }
        return null;
    }


    public static function getAdmin()
    {
        return self::all();
    }

    public static function getaccountByID($id)
    {
        $admin = self::find($id);
        if ($admin) {
            // Chuyển đổi đối tượng Admin thành mảng
            $adminArray = $admin->toArray();
            return $adminArray;
        }
        return null;
    }

    // Admin.php

    public function updateAccount($id, $data)
    {
        // Update account information directly
        $this->where('IDAD', $id)->update([
            'Name' => $data['Name'],
            'Hoten' => $data['Hoten'],
            'Email' => $data['Email'],
            'MatKhau' => $data['MatKhau'],
            'roleID' => $data['roleID'],
            'TrangThai' => $data['TrangThai']
        ]);
    }

    public static function changeStatusAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        $oldTrangThai = $admin->TrangThai;
        $admin->update(['TrangThai' => !$oldTrangThai]);
        return $oldTrangThai;
    }

    public static function deleteAdminById($id)
    {
        self::destroy($id);
    }

}
