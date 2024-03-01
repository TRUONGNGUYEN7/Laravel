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

    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'permission_role', 'roleID', 'permissionID');
    }

    public static function updatePermissionRole($id, $selectedActions)
    {
        $role = PermissionRole::find($id);
            if($role){
                $role->permissions()->sync($selectedActions);
            }else{
                foreach ($selectedActions as $actionId) {
                self::create([
                    'roleID' => $id,
                    'permissionID' => $actionId,
                ]);
            }
        }
    }

    public static function addPermissionRole($resultaddrole, $selectedActions, $Status)
    {
        // self::where('roleID', $resultaddrole)->delete();
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
