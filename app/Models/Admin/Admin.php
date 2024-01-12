<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    protected $table = 'tbladmin';

    public static function Authenticate($adminname, $adminpass)
    {
        $adminpass = md5($adminpass);

        return DB::table('tbladmin')
            ->where('Ten', $adminname)
            ->where('MatKhau', $adminpass)
            ->first(); // Change this to first() if expecting a single record
    }
}
