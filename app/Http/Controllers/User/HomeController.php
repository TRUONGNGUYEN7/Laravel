<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    protected $moduleName = 'user';
    public function __construct()
    {
        $this->controllerName     = 'dashboard';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle = 'user';
        view()->share([
            'moduleName'     => $this->moduleName,
            'controllerName' => $this->controllerName,
            'pageTitle'=> $this->pageTitle
        ]);
    }


}
