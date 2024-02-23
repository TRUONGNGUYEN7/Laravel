<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPermission extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'grouppermission';
    public $incrementing = false;
    protected $fillable = [
          'id',  'name',  'displayName'
    ];

    public static function getActiveGroupPermission() {
        return self::where('status', 1)->get();
    }
}
