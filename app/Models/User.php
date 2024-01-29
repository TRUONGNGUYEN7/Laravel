<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'IDCD';
    protected $table = 'tbluser';
    protected $fillable = [
        'IDUS', 'TenUS', 'MatKhauUS', 'TrangThaiUS'
    ];


    public static function Signup($request)
    {
        try {
            $User = new self();
            $User->TenUS = $request->name;
            $User->MatKhauUS = Hash::make($request->password); 
            $User-> EmailUS= $request->email;
            $User-> TrangThaiUS = 1;
            $User->save();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function Signin($username, $userpass)
    {
        // Lấy thông tin người dùng từ cơ sở dữ liệu
        $user = DB::table('tbluser')
            ->where('TenUS', $username)
            ->first();

        // Kiểm tra xem có người dùng không
        if ($user) {
            // Kiểm tra mật khẩu
            if (Hash::check($userpass, $user->MatKhauUS)) {
                return $user; // Mật khẩu hợp lệ, trả về người dùng
            }
        }

        return false; // Mật khẩu không hợp lệ hoặc người dùng không tồn tại
    }
    
}
