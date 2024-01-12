<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
          'IDBV',  'TenBV', 'Mota', 'NoiDung', 'HinhAnh', 'ChuDeID', 'LuotXem', 'TrangThaiBV'
    ];
 
    protected $primaryKey = 'IDBV';
    protected $table = 'tblbaiviet';

    public static function createNewPost($request)
    {
        $tenBaiViet = $request->tenbaiviet;
        $postCheck = self::where('TenBV', $tenBaiViet)->first();

        if ($postCheck) {
            return redirect()->back()->with('error', 'Chủ đề đã tồn tại');
        } else {
            $post = new self();

            if ($request->hasFile('hinhanh')) {
                $file = $request->file('hinhanh');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('hinhanh'), $filename);
                $post->HinhAnh = $filename;
            } 

            $post->TrangThaiBV = $request->has('hienthi') ? 1 : 0;
            $post->TenBV = $tenBaiViet;
            $post->ChuDeID = $request->idchude;
            $post->Mota = $request->mota;
            $post->LuotXem = '0';
            $post->NoiDung = $request->noidung;
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
            if ($request->hasFile('hinhanh')) {
                $file = $request->file('hinhanh');
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


}
