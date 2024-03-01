<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAdmin extends Model
{
    use HasFactory;
    protected $table = 'role_admin';
    protected $primaryKey = 'adminID'; // Chỉ định trường roleID làm khóa chính
    protected $fillable = ['adminID','roleID'];
    public $timestamps = false;
    public $incrementing = false;
}
