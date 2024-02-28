<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use HasFactory;

    protected $table = 'permission_role';
    protected $primaryKey = 'roleID'; // Chỉ định trường roleID làm khóa chính
    protected $fillable = ['roleID', 'permissionID'];
    public $timestamps = false;
    public $incrementing = false;

    public static function updatePermissionRole($roleId, $selectedActions)
    {
        $role = Roles::findOrFail($roleId);

        $role->permissions()->sync($selectedActions);
    }

    public static function addPermissionRole($resultaddrole, $selectedActions, $Status)
    {
        self::where('roleID', $resultaddrole)->delete();
        foreach ($selectedActions as $actionId) {
            self::create([
                'roleID' => $resultaddrole,
                'permissionID' => $actionId,
            ]);
        }
    }

    public function getRoutesPermission($id)
    {
       return $RoutesPermission = self::where('roleID', $id)->get();
    }
}
