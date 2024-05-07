<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use DateTime;
use App\Models\AdminModel;
use App\Models\FTPModel;
use DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler;
class Post extends AdminModel
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'baiviet';
    protected $fillable = [
        'id',  'name', 'describe', 'content', 'image'. 'imageHash', 'created', 'chudeID', 'created', 'created_by', 'modified', 'modified_by'
    ];

    public static function getItem($params = null, $options = null)
    {
        $result = null;
        if($options['task'] == 'get-item') {
            $result = self::where('id', $params['id'])->first();
        }
        return $result;
    }

    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'add-item') {
            if (isset($params['image'])) {
                $image = $params['image'];
                $params['imageHash'] = FTPModel::uploadImageToFTP($image);
                // Lưu nội dung từ CKEditor
                $content = $params['content']; // Đây là nội dung bạn nhận được từ CKEditor
                // Tìm kiếm các hình ảnh trong nội dung CKEditor
                preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches, PREG_SET_ORDER);
                
                // Duyệt qua từng hình ảnh trong nội dung
                foreach ($matches as $match) {
                    $imageUrl = $match[1];
                    
                    // Kiểm tra xem đường dẫn hình ảnh là base64 hay URL
                    if (strpos($imageUrl, 'data:image') === 0) {                   
                        // Xử lý hình ảnh dưới dạng base64
                        $imageHashContent = FTPModel::uploadImageFromBase64ToFTP($imageUrl);
                    } else {
                        // Xử lý hình ảnh dưới dạng URL
                        $imageHashContent = FTPModel::uploadImageFromURLToFTP($imageUrl);
                    }
                    
                    // Thay thế đường dẫn hình ảnh trong nội dung CKEditor bằng đường dẫn trên FTP
                    $content = str_replace($imageUrl, $imageHashContent, $content);
                }
                // Tiếp theo, lưu vào cơ sở dữ liệu
                $params['content'] = $content;
            }
            $this->setCreatedHistory($params);
            self::insert($this->prepareParams($params));
        }
        if ($options['task'] == 'edit-item') {
            if (isset($params['image'])) {
                $image = $params['image'];
                $params['imageHash'] = FTPModel::uploadImageToFTP($image);
                // Lưu nội dung từ CKEditor
                $content = $params['content']; // Đây là nội dung bạn nhận được từ CKEditor
                // Kiểm tra xem ảnh là base64 hay URL
                if (preg_match('/data:image\/[^;]+;base64,/', $content)) {
                    $content = FTPModel::processBase64Images($content);
                } else {
                    $content = FTPModel::processURLImages($content);
                }
                // Tiếp theo, lưu vào cơ sở dữ liệu
                $params['content'] = $content;
            }
            $this->setModifiedHistory($params);
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }

    public static function getFourPostsByChuDe($idchude)
    {
        return self::join('chude', 'baiviet.chudeID', '=', 'chude.id')
            ->where('chude.id', $idchude)
            ->orderByDesc('baiviet.id')
            ->take(4)
            ->get();
    }

    public static function getActivePosts($sl) {
        return self::where('status', 'active')
        ->take($sl)
        ->get();
    }

    public static function getPostForEdit($id) {
        return self::join('chude', 'baiviet.chudeID', '=', 'chude.id')
            ->where('baiviet.id', $id)
            ->get();
    }

    public static function getViewsPosts($sl) {
        return self::where('status', 'active')
        ->orderByDesc('baiviet.views')
        ->take($sl)
        ->get();
    }

    public static function ViewPlusPost($id) {
        $post = self::find($id);

        if ($post) {
            $lx = $post->views;
            $post->views = $lx + 1;
            $post->save();
        }
    }

    public static function getPostsWithChudeInfo() {
        // Sử dụng Eloquent query ở đây, ví dụ:
        return self::join('chude', 'chude.id', '=', 'baiviet.chudeID')
        ->orderByDesc('baiviet.id')
        ->select('baiviet.*', 'chude.name');
    }

    public static function getPosts($id)
    {
        return self::orderByDesc('baiviet.id')
        ->take($id)
        ->get();
    }
    public static function getCategoryById($id) {
        return self::where('id', $id)->get();
    }

    public static function getPostsCate($id, $sobaiviet)
    {
        return self::select('baiviet.*')
            ->join('chude', 'baiviet.chudeID', '=', 'chude.id')
            ->join('danhmuc', 'chude.danhmucID', '=', 'danhmuc.id')
            ->where('danhmuc.id', $id)
            ->orderByDesc('baiviet.id')
            ->take($sobaiviet)
            ->get();
    }

    public static function getPostSubCate($id, $sobaiviet)
    {
        return self::select('baiviet.*')
        ->join('chude', 'baiviet.chudeID', '=', 'chude.id')
        ->where('chude.id', $id)
        ->orderByDesc('baiviet.id')
        ->take($sobaiviet)
        ->get();
    }

    public static function getChuDeData($idchude, $idanhmuc)
    {
        $maxViewPost = self::join('chude', 'baiviet.chudeID', '=', 'chude.id')
        ->join('danhmuc', 'chude.danhmucID', '=', 'danhmuc.id')
        ->where('danhmuc.id', $idanhmuc)
        ->orderByDesc('baiviet.id')
        ->take(1)
        ->get();

        $fourPosts = collect(); // Tạo một Collection trống mặc định.
        if (!$maxViewPost->isEmpty()) {
            // Lấy 4 bài viết khác trong cùng danh mục
            $fourPosts = self::join('chude', 'baiviet.chudeID', '=', 'chude.id')
                ->join('danhmuc', 'chude.danhmucID', '=', 'danhmuc.id')
                ->where('danhmuc.id', $idanhmuc)
                ->where('baiviet.id', '<>', $maxViewPost->first()->id)
                ->orderByDesc('baiviet.id')
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
        $post = new self();

        if ($request->hasFile('hinhanhthem')) {
            $file = $request->file('hinhanhthem');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('hinhanh'), $filename);
            $post->HinhAnh = $filename;
        } 
        if ($request->videolink) {
            $post->HinhAnh = $request->videolink;
        }

        $adminData = session('admin_data');

        $post->status = $request->has('hienthi') ? 1 : 0;
        $post->TenBV = $tenBaiViet;
        $post->chudeID = $request->idchude;
        $post->Mota = $request->mota;
        $post->views = '0';
        $post->ThoiGianBV = now();
        $post->NoiDung = $request->noidung;
        $post->NguoiDangBV = $adminData['admin_username'];
        $post->save();
    }

    public static function updatePost($request, $id)
    {
        // Update directly at the given ID
        self::where('id', $id)->update([
            'TenBV' => $request->tenbaiviet,
            'chudeID' => $request->idchude,
            'Mota' => $request->mota,
            'NoiDung' => $request->noidung,
            'ThoiGianBV' => now(),
            'status' => $request->filled('hienthi'),
        ]);

        // Handle file upload
        if ($request->hasFile('hinhanhsua')) {
            $baiViet = self::find($id);
            $currentImageName = $baiViet->HinhAnh;

            $file = $request->file('hinhanhsua');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('hinhanh'), $filename);

            // Xóa ảnh cũ nếu tồn tại
            $oldImagePath = public_path('hinhanh/') . $currentImageName;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Cập nhật tên file mới
            $baiViet->HinhAnh = $filename;
            $baiViet->save();
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
            $record = self::find($params['id']);
            if (!$record) {
                return false;
            }

            $imagePath = public_path('hinhanh/') . $record->HinhAnh;
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $record->delete();
        }
    }

    public static function changeStatusPost($id)
    {
        $admin = self::findOrFail($id);
        $oldTrangThai = $admin->status;
        $admin->update(['status' => !$oldTrangThai]);
        return $oldTrangThai;
    }


    public function chude()
    {
        return $this->belongsTo(Subcategory::class, 'chudeID');
    }

    public function admin()
    {
        return $this->belongsTo(AdminModel::class, 'created_by');
    }
}
