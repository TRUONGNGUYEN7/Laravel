<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Helpers\FTPHelper;
use App\Models\AdminModel;
use DateTime;
use DB;

class Post extends AdminModel
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'baiviet';
    protected $fillable = [
        'id',  'name', 'describe', 'content', 'image', 'created', 'chudeID', 'created', 'created_by', 'modified', 'modified_by'
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
        $type = 'imagesPost';
        if ($options['task'] == 'add-item') {
                 
            $contentreplace = FTPHelper::processImagesInContent($params['content'], $type);

            $params['content'] = $contentreplace;
            //dd($contentreplace);
            $params['image'] = FTPHelper::uploadImageToFTP($params['image']); //upload image logo
            $this->setCreatedHistory($params);
            self::create($this->prepareParams($params));
        }
        if ($options['task'] == 'edit-item') {
            $contentreplace = FTPHelper::processImagesInContent($params['content'], $type);
            $item = Post::find($params['id']);
            FTPHelper::deleteImagesContentFTP($item->content, $type);
            $params['content'] = $contentreplace;
            if (isset($params['image'])) {       
                $params['image'] = FTPHelper::uploadImageToFTP($params['image'], $params['id']); //upload image logo
            }
            $this->setModifiedHistory($params);
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
        // Xóa các tệp trong thư mục public/media
        File::deleteDirectory(public_path('media'));
    }
    
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
            $record = self::find($params['id']);
            if (!$record) {
                return false;
            }

            FTPHelper::deleteImagesFromFTP($record->content, $record->image, 'imagesPost');
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



    public function chude()
    {
        return $this->belongsTo(Subcategory::class, 'chudeID');
    }

    public function admin()
    {
        return $this->belongsTo(AdminModel::class, 'created_by');
    }
}
