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
            // Kiểm tra xem tên người dùng đã tồn tại trong cơ sở dữ liệu hay không
            $existingUser = self::where('TenUS', $request->TenUS)->first();
            
            // Nếu tên người dùng đã tồn tại, trả về false
            if ($existingUser) {
                $request->session()->flash('message', 'Tên user đã tồn tại');
                return false;
            }
            
            // Nếu tên người dùng chưa tồn tại, tiến hành tạo mới người dùng
            $User = new self();
            $User->TenUS = $request->TenUS;
            $User->MatKhauUS = Hash::make($request->MatKhauUS); 
            $User->EmailUS = $request->EmailUS;
            $User->TrangThaiUS = 1;
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
