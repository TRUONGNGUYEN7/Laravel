<!DOCTYPE html>

<head>
    <title>Trang chủ Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{ asset('assetadmin/css/csstable.css') }}">
    <meta name="keywords" content="Trang chủ admin" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('assetadmin/css/bootstrap.min.css') }}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset('assetadmin/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('assetadmin/css/style-responsive.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('assetadmin/css/font.css') }}" type="text/css" />
    <link href="{{ asset('assetadmin/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assetadmin/css/morris.css') }}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('assetadmin/css/monthly.css') }}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{ asset('assetadmin/js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ asset('assetadmin/js/raphael-min.js') }}"></script>
    <script src="{{ asset('assetadmin/js/morris.js') }}"></script>
</head>

<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh; /* Set minimum height of the viewport */
    }

    #main-content {
        flex: 1;
    }

    .footer {
        background-color: #f1f1f1;
        text-align: center;
        bottom: 0;
        width: 100%;
        position: relative;
        color: pink; /* Add this line to set the text color to pink */
    }


    .sizetextdm {
        font-size: 17px;
    }

    .sizetextdm2 {
        font-size: 15px;
    }
</style>
<style>
    .sizetextdm{
        font-size: 17px;
    }
</style>
<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index.html" class="logo">
                    ADMIN
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">

                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="images/2.png">
                            <span class="username">
                            <?php
                                $adminData = Session::get('admin_data');
                                $adminUsername = isset($adminData['admin_username']) ? $adminData['admin_username'] : null;
                                $adminId = isset($adminData['admin_id']) ? $adminData['admin_id'] : null;
                            ?>
                            {{ $adminUsername }}

                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="{{ URL::to('/admin/logout') }}"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{ URL::to('/admin') }}">
                                <i class="fa fa-dashboard"></i>
                                <span class="sizetextdm">Trang Chủ</span>
                                
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span class="sizetextdm">Danh Mục</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ route('admin.danhmuc.them') }}">Thêm danh mục</a></li>
                                <li><a href="{{ route('admin.danhmuc.lietke') }}">Liệt kê danh mục</a></li>                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span class="sizetextdm">Chủ Đề</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ route('admin.chude.them') }}">Thêm chủ đề</a></li>
                                <li><a href="{{ route('admin.chude.lietke') }}">Liệt kê chủ đề</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-tasks"></i>
                                <span class="sizetextdm">Bài Viết</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ route('admin.baiviet.them') }}">Thêm bài viết</a></li>
                                <li><a href="{{ route('admin.baiviet.lietke') }}">Danh sách bài viết</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
    <!-- main content start -->
    <section id="main-content">
        <section class="wrapper">
            @yield('adcontent')
        </section>
        <!-- main content end -->
        <!-- <div class="footer">
            <p style="color: blue">Design by NNT</a></p>
        </div> -->
    </section>

        <!--main content end-->
    </section>
    <script src="{{ asset('assetadmin/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assetadmin/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('assetadmin/js/scripts.js') }}"></script>
    <script src="{{ asset('assetadmin/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assetadmin/js/jquery.nicescroll.js') }}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{ asset('assetadmin/js/jquery.scrollTo.js') }}"></script>
    <script src="{{ asset('assetadmin/ckeditor/ckeditor.js') }}"></script>
    <!-- morris JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/formvalidation/0.6.2-dev/css/formValidation.min.css"></script>
    <script type="text/javascript">
        CKEDITOR.replace('ckeditor')
    </script>
    <!-- //calendar -->
</body>

</html>
