<?php

return [
    'url'              => [
        'prefix_admin' => 'admin',
        'prefix_frontEnd'  => 'user',
    ],
    'format'           => [
        'long_time'         => 'H:m:s d/m/Y',
        'short_time'        => 'd/m/Y',
        'my_sql'            => 'Y-m-d',
        'number_decimals'   => 0,
        'dec_point'         => ',', //Dấu thập phân
        'thousands_sep'     => '.' //Dấu phân cách phần ngàn
    ],
    'folderUpload'  => [
        'mainFolder' =>'fileUpload',
    ],
    'template'         => [
        'form_input' => [
            'class' => 'form-control'
        ],
        'form_width_input' => [
            'class' => 'col-md-9 col-sm-9 col-xs-12'
        ],
        'form_input_datepicker' => [
            'class' => 'form-control col-md-12 col-xs-12 datepicker'
        ],
        'form_input_select2' => [
            'class' => 'form-control col-md-12 col-xs-12 select2'
        ],
        'form_label' => [
            'class' => 'col-md-3 col-sm-3 col-form-label'
        ],
        'form_label_lg' => [
            'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
        ],
        'form_label_edit' => [
            'class' => 'control-label col-md-4 col-sm-4 col-xs-12'
        ],
        'form_ckeditor' => [
            'class' => 'form-control col-md-6 col-xs-12 ckeditor'
        ],
        'status'       => [
            'all'      => ['name' => 'Tất cả', 'class' => 'btn-primary'],
            'active'   => ['name' => 'Kích hoạt', 'class'      => 'btn-success'],
            'inactive' => ['name' => 'Chưa kích hoạt', 'class' => 'btn-info'],
        ],
        'search'       => [
            'all'      => ['name'=>'Tìm kiếm Tất cả'],
            'name'     => ['name'=>'Tìm kiếm theo Tên'],
            'fullName' => ['name'=>'Tìm kiếm theo Họ tên'],
        ],
        'button' => [
            'add'      => ['class'=> 'btn-primary btn-add'         , 'title'=> 'Thêm'       , 'icon' => 'fa fa-plus'     , 'route-name' => '/form'],
            'edit'     => ['class'=> 'btn-success btn-edit'         , 'title'=> 'Sửa'       , 'icon' => 'fa fa-pencil-alt'     , 'route-name' => '/form'],
            'delete'   => ['class'=> 'btn-danger btn-delete'        , 'title'=> 'Xóa'       , 'icon' => 'fa fa-trash-alt'      , 'route-name' => '/delete'],
        ],
        'label' =>[
            'name'                  => 'Tên',
            'image'                => 'Hình ảnh',
            'fullName'              => 'Họ tên',
            'roleID'                => 'Nhóm người dùng',
            'password'              => 'Mật khẩu',
            'password_confirmation' => 'Nhập lại mật khẩu',
            'username'              => 'Username',
            'email'                 => 'Email',
            'avatar'                => 'Avatar',
            'ngayThang'             => 'Ngày tháng',
            'fileSingle'            => 'File Single',
            'fileMuti'              => 'File Muti',
            'status'                => 'Trạng thái'
        ]
    ],
    'config' => [
        'search' => [
            'default'           => ['name']
        ],
        'button' => [
            'default'   => ['edit', 'delete'],
        ]
    ]
];