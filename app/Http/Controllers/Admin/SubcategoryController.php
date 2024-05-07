<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Subcategory as MainModel;
use App\Models\Category;
use App\Http\Requests\SubCategoryRequest as MainRequest;
use App\Http\Controllers\Admin\BaseController;

class SubcategoryController extends BaseController
{

    public function __construct()
    {
        $this->controllerName     = 'subcategory';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->model = new MainModel();
        $this->pageTitle          = 'Chủ đề';
        view()->share([
            'moduleName'     => $this->moduleName,
            'controllerName' => $this->controllerName,
            'pageTitle'=> $this->pageTitle,
            'pathViewController'=> $this->pathViewController
        ]);
    }

    public function index()
    {
        $ds = MainModel::paginate(5)->fragment('ds');
        return view($this->pathViewController .  'index', [])->with('ds', $ds);
    }

    public function form(Request $request)
    {
        $item = null;
        $ds = Category::where('status', 'active')->get();
        if ($request->id !== null)
        {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
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
        $value = MainModel::changeStatusSubcategory($id);
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
