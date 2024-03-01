<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    protected $table = 'tbladmin';
    protected $primaryKey = 'IDAD';
    protected $fillable = [
        'IDAD', 'Name', 'Hoten', 'Email', 'MatKhau', 'roleID', 'TrangThai'
    ];

    public static function Authenticate($adminname, $adminpass)
    {
        $admin = DB::table('tbladmin')
                    ->where('Name', $adminname)
                    ->first(); // Change this to first() if expecting a single record

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
        $admin = $this->findOrFail($id); // Find the account by ID

        // Update account information
        $admin->update([
            'Name' => $data['Name'],
            'Hoten' => $data['Hoten'],
            'Email' => $data['Email'],
            'MatKhau' => $data['MatKhau'],
            'roleID' => $data['roleID'],
            'TrangThai' => $data['TrangThai']
        ]);

        return $admin;
    }

    public static function deleteAdminById($id)
    {
        self::destroy($id);
    }

}
