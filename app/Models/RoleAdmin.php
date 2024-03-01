<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAdmin extends Model
{
    use HasFactory;
    protected $table = 'role';
    protected $primaryKey = 'roleID'; // Chỉ định trường roleID làm khóa chính
    protected $fillable = ['roleID', 'permissionID'];
    public $timestamps = false;
    public $incrementing = false;
}
