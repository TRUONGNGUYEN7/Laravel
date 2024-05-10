<?php

namespace App\Http\Controllers\Admin;
use DateTime;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Post as MainModel;
use App\Models\FTPModel;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest as MainRequest;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Str;
use App\Helpers\FTPHelper;
use Illuminate\Support\Facades\Response;
class PostController extends BaseController
{
    public function __construct()
    {
        $this->controllerName     = 'post';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->model = new MainModel();
        $this->pageTitle          = 'bài viết';
        view()->share([
            'moduleName'     => $this->moduleName,
            'controllerName' => $this->controllerName,
            'pageTitle'=> $this->pageTitle,
            'pathViewController'=> $this->pathViewController
        ]);
    }
    
    public function displayImage($fileName)
    {
        // Xây dựng đường dẫn tới tệp hình ảnh trong thư mục 'imagesPost/'
        $filePath = 'imagesPost/' . $fileName;

        // Đọc dữ liệu của file hình ảnh từ máy chủ FTP
        $imageData = Storage::disk('ftp')->get($filePath);

        // Thiết lập các header cho loại nội dung của hình ảnh
        $headers = [
            'Content-Type' => 'image/jpeg', // Thay 'image/jpeg' bằng loại nội dung tương ứng của hình ảnh của bạn
        ];

        // Trả về phản hồi có dữ liệu của hình ảnh và các header được thiết lập
        return Response::make($imageData, 200, $headers);
    }

    public function index()
    {
        $ds = MainModel::orderBy('id', 'desc')->paginate(5);
        return view($this->pathViewController .  'index', [])->with('ds', $ds);
    }

    public function form(Request $request)
    {
        $item = null;
        $ds = Subcategory::where('status', 'active')->get();
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
            // $fileName = $item['imageHash'];
            // $tempFilePath = 'fileUpload/' . $fileName;
            // Storage::disk('ntg_storage')->put($fileName, Storage::disk('ftp')->get($fileName));
        }
        return view($this->pathViewController .  'form', [
            'item'        => $item,
            'ds'        => $ds
        ]);
    }
    
    public function save(MainRequest $request)
    {
        if ($request->validator && $request->validator->fails()) {
            $errors = $request->validator->errors();
            return back()->with('errors', $errors)->withInput();
        }
        
        if ($request->isMethod('POST')) {
            $params = $request->all();
            $task   = "add-item";
            $notify = "Thêm mới $this->pageTitle thành công!";
            
            if ($params['id'] !== null) {
                $task   = "edit-item";
                $notify = "Cập nhật $this->pageTitle thành công!";
            }

            $item = $this->model->saveItem($params, ['task' => $task]);
            return back()->with('ntg_notify', $notify);
        }
    }

    public function status($id)
    {
        $value= MainModel::changeStatusPost($id);
        return response()->json(['status' => $value]);
    }

    public function delete(Request $request)
    {
        $params["id"]             = $request->id;
        $this->model->deleteItem($params, ['task' => 'delete-item']);
        $notify = "Xóa $this->pageTitle thành công!";
        return back()->with('ntg_notify', $notify);
    }
}
