<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    protected $moduleName = 'admin';
    protected $pathViewController = '';
    protected $params             = [];
    protected $model;
    protected $controllerName     = 'base';
    protected $pageTitle          = '';
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            view()->share([
                'moduleName'                 => $this->moduleName,
                'controllerName'             => $this->controllerName,
                'pageTitle'                  => $this->pageTitle
            ]);
            return $next($request);
        });
    }
}