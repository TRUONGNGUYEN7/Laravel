<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use DateTime;
class Post extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
          'IDBV',  'TenBV', 'Mota', 'NoiDung', 'HinhAnh', 'NguoiDangBV', 'ChuDeID', 'LuotXem', 'TrangThaiBV', 'ThoiGianBV'
    ];
    protected $primaryKey = 'IDBV';
    protected $table = 'tblbaiviet';

    public static function getFourPostsByChuDe($idchude)
    {
        return self::join('tblchude', 'tblbaiviet.ChuDeID', '=', 'tblchude.IDCD')
            ->where('tblchude.IDCD', $idchude)
            ->orderByDesc('tblbaiviet.IDBV')
            ->take(4)
            ->get();
    }

    public static function getActivePosts() {
        return self::where('TrangThaiBV', 1)
        ->get();
    }

    public static function getPostForEdit($id) {
        return self::join('tblchude', 'tblbaiviet.ChuDeID', '=', 'tblchude.IDCD')
            ->where('tblbaiviet.IDBV', $id)
            ->get();
    }

    public static function getViewsPosts() {
        return self::where('TrangThaiBV', 1)
        ->orderByDesc('tblbaiviet.LuotXem')
        ->take(5)
        ->get();
    }

    public static function ViewPlusPost($id) {
        $post = self::find($id);
        if ($post) {
            $lx = $post->LuotXem;
            $post->LuotXem = $lx + 1;
            $post->save();
        }
    }
    
    public static function getPostsWithChudeInfo() {
         // Sử dụng Eloquent query ở đây, ví dụ:
         return self::join('tblchude', 'tblchude.IDCD', '=', 'tblbaiviet.ChuDeID')
         ->orderByDesc('tblbaiviet.IDBV')
         ->select('tblbaiviet.*', 'tblchude.TenChuDe');
    }

    public static function getLatestPosts($id= null)
    {
        if($id !== null)
        {
            return self::join('tblchude', 'tblchude.IDCD', '=', 'tblbaiviet.ChuDeID')
            ->orderByDesc('tblbaiviet.IDBV')
            ->take($id)
            ->get();
        }else{
            return self::join('tblchude', 'tblchude.IDCD', '=', 'tblbaiviet.ChuDeID')
            ->orderByDesc('tblbaiviet.IDBV')
            ->take(4)
            ->get();
        }

    }

    public static function getPostsCate($id, $sobaiviet)
    {
        return Post::join('tblchude', 'tblbaiviet.ChuDeID', '=', 'tblchude.IDCD')
        ->join('tbldanhmuc', 'tblchude.DanhMucID', '=', 'tbldanhmuc.IDDM')
        ->where('tbldanhmuc.IDDM', $id)
        ->orderByDesc('tblbaiviet.IDBV')
        ->take($sobaiviet)
        ->get();
    }

    public static function getPostSubCate($id, $iddm, $sobaiviet)
    {
        return self::join('tblchude', 'tblbaiviet.ChuDeID', '=', 'tblchude.IDCD')
        ->where('tblchude.IDCD', $id)
        ->orderByDesc('tblbaiviet.IDBV')
        ->take($sobaiviet)
        ->get();
    }

    public static function getChuDeData($idchude, $idanhmuc)
    {
        $maxViewPost = self::join('tblchude', 'tblbaiviet.ChuDeID', '=', 'tblchude.IDCD')
        ->join('tbldanhmuc', 'tblchude.DanhMucID', '=', 'tbldanhmuc.IDDM')
        ->where('tbldanhmuc.IDDM', $idanhmuc)
        ->orderByDesc('tblbaiviet.IDBV')
        ->take(1)
        ->get();

        $fourPosts = collect(); // Tạo một Collection trống mặc định.
        if (!$maxViewPost->isEmpty()) {
            // Lấy 4 bài viết khác trong cùng danh mục
            $fourPosts = self::join('tblchude', 'tblbaiviet.ChuDeID', '=', 'tblchude.IDCD')
                ->join('tbldanhmuc', 'tblchude.DanhMucID', '=', 'tbldanhmuc.IDDM')
                ->where('tbldanhmuc.IDDM', $idanhmuc)
                ->where('tblbaiviet.IDBV', '<>', $maxViewPost->first()->IDBV)
                ->orderByDesc('tblbaiviet.IDBV')
                ->take(4)
                ->get();
        }

        $menuCategory = Category::where('TrangThaiDM', 1)->get();
        $ttdanhmuc = Category::find($idanhmuc);

        return [
            'menuCategory' => $menuCategory,
            'ttdanhmuc' => $ttdanhmuc,
            'maxViewPost' => $maxViewPost,
            'FourPosts' => $fourPosts,
        ];
    }

    public static function createNewPost($request)
    {
        $tenBaiViet = $request->tenbaiviet;
        $postCheck = self::where('TenBV', $tenBaiViet)->first();

        if ($postCheck) {
            return redirect()->back()->with('error', 'Chủ đề đã tồn tại');
        } else {
            $post = new self();

            if ($request->hasFile('hinhanhthem')) {
                $file = $request->file('hinhanhthem');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('hinhanh'), $filename);
                $post->HinhAnh = $filename;
            } 
            $adminData = session('admin_data');

            $post->TrangThaiBV = $request->has('hienthi') ? 1 : 0;
            $post->TenBV = $tenBaiViet;
            $post->ChuDeID = $request->idchude;
            $post->Mota = $request->mota;
            $post->LuotXem = '0';
            $post->ThoiGianBV = now();
            $post->NoiDung = $request->noidung;
            $post->NguoiDangBV = $adminData['admin_username'];
            $post->save();

            Session::put('message', 'Thêm thành công');
            return back();
        }
    }

    public static function updatePost($request, $id)
    {
        $baiViet = self::find($id);

        if (!$baiViet) {
            Session::put('message', 'Bài viết không tồn tại!!!');
            return back();
        }

        $tenBaiVietMoi = $request->tenbaiviet;
        $currentImageName = $request->hinhanhcurrent;
        $kiemTraTonTai = self::where('TenBV', $tenBaiVietMoi)
            ->where('IDBV', '<>', $id)
            ->exists();

        if ($kiemTraTonTai) {
            Session::put('message', 'Tên bài viết đã tồn tại!!!');
        } else {
            if ($request->hasFile('hinhanhsua')) {
                $file = $request->file('hinhanhsua');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('hinhanh'), $filename);
                $oldImagePath = public_path('hinhanh/') . $currentImageName;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
                $baiViet->HinhAnh = $filename;
            } else {
                $baiViet->HinhAnh = $request->has('image') ? $request->image : $currentImageName;
            }

            $baiViet->TenBV = $tenBaiVietMoi;
            $baiViet->ChuDeID = $request->idchude;
            $baiViet->Mota = $request->mota;
            $baiViet->NoiDung = $request->noidung;
            $baiViet->ThoiGianBV = now();
            $baiViet->TrangThaiBv = $request->has('hienthi') ? 1 : 0;
            $baiViet->save();

            Session::put('message', 'Cập nhật thành công!!!');
            return back();
        }
    }
    public static function deletePostById($id)
    {
        $baiViet = self::find($id);

        if ($baiViet) {
            $imagePath = public_path('hinhanh/') . $baiViet->HinhAnh;
            
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            self::destroy($id);
        }
    }

    public static function StatusPostById($id, $value)
    {
        $post = self::find($id);

        if ($post) {
            if($value == 0)
            {
                $post->TrangThaiBV = 1;
                $post->save();
            }else
            {
                $post->TrangThaiBV = 0;
                $post->save();
            }

        }
    }

    public function chude()
    {
        return $this->belongsTo(Subcategory::class, 'ChuDeID');
        
    }
}
