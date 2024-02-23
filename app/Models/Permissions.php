<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'permissions';
    public $incrementing = false;
    protected $fillable = ['name', 'displayName', 'groupPermissionID'];

    public function getActiveRoutes($id)
    {
       return $activeRoutes = self::where('groupPermissionID', $id)->get();
    }
}
