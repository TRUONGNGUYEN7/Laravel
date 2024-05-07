<header>
    <!-- Header desktop -->
    <div style="background-color: #daecff;" class="container-menu-desktop">
        <div class="topbar">
            <div class="content-topbar container h-100">
                <div class="left-topbar">

                    @if (Auth::guard('user')->user())
                        <!-- Hiển thị tên người dùng nếu đã đăng nhập -->
                        <span class="left-topbar-item">Welcome, {{ Auth::guard('user')->user()->name }}</span>

                        <!-- Hiện mục đăng xuất -->
                        <a href="{{ route("auth/logout") }}" class="left-topbar-item">
                            Log out
                        </a>
                    @else
                        <!-- Hiển thị các mục Home, Sign up, và Log in nếu chưa đăng nhập -->
                        <a href="{{ route("user/index") }}" class="left-topbar-item">
                            Home
                        </a>
  
                        <a href="#" class="left-topbar-item" onclick="signUpShowPopup()">
                            Sign up
                        </a>

                        <a href="#" class="left-topbar-item" onclick="loginShowPopup()">
                            Log in
                        </a>

                    @endif

                </div>

                <div class="right-topbar">

                </div>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="index.html"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze m-r--8">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="topbar-mobile">
                <li class="left-topbar">
                    <span class="left-topbar-item flex-wr-s-c">
                        <span>
                            New York, NY
                        </span>

                        <img class="m-b-1 m-rl-8" src="images/icons/icon-night.png" alt="IMG">

                        <span>
                            HI 58° LO 56°
                        </span>
                    </span>
                </li>

                <li class="left-topbar">
                    <a href="#" class="left-topbar-item">
                        About
                    </a>

                    <a href="#" class="left-topbar-item">
                        Contact
                    </a>

                    <a href="{{ route("auth/signup") }}" class="left-topbar-item">
                        Sign up
                    </a>

                    <a href="#" class="left-topbar-item">
                        Log in
                    </a>
                </li>

                <li class="right-topbar">
                    <a href="#">
                        <span class="fab fa-facebook-f"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-twitter"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-pinterest-p"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-vimeo-v"></span>
                    </a>

                    <a href="#">
                        <span class="fab fa-youtube"></span>
                    </a>
                </li>
            </ul>

            <ul class="main-menu-m">
                <li>
                    <a href="index.html">Homee</a>
                    <ul class="sub-menu-m">
                        <li><a href="index.html">Homepage v11</a></li>
                        <li><a href="home-02.html">Homepage v2</a></li>
                        <li><a href="home-03.html">Homepage v3</a></li>
                    </ul>

                    <span class="arrow-main-menu-m">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                </li>

                <li>
                    <a href="category-01.html">News</a>
                </li>

                <li>
                    <a href="category-02.html">Entertainment </a>
                </li>

                <li>
                    <a href="category-01.html">Business</a>
                </li>

                <li>
                    <a href="category-02.html">Travel</a>
                </li>

                <li>
                    <a href="category-01.html">Life Style</a>
                </li>

                <li>
                    <a href="category-02.html">Video</a>
                </li>

                <li>
                    <a href="#">Features</a>
                    <ul class="sub-menu-m">
                        <li><a href="category-01.html">Category Page v1</a></li>
                        <li><a href="category-02.html">Category Page v2</a></li>
                        <li><a href="blog-grid.html">Blog Grid Sidebar</a></li>
                        <li><a href="blog-list-01.html">Blog List Sidebar v1</a></li>
                        <li><a href="blog-list-02.html">Blog List Sidebar v2</a></li>
                        <li><a href="blog-detail-01.html">Blog Detail Sidebar</a></li>
                        <li><a href="blog-detail-02.html">Blog Detail No Sidebar</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>

                    <span class="arrow-main-menu-m">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                </li>
            </ul>
        </div>

        @include("$moduleName.elements.head")

    </div>
</header>
<div class="wrap-main-nav">
    <div style="background-color: #c4dbff; color: white" class="main-nav">
        <!-- Menu desktop -->
        <nav class="menu-desktop">
            <ul class="main-menu">

                <a style="margin-left: -10px; margin-right: 10px; font-size: 18px"
                    href="{{ route("$moduleName/index") }}"><i class="fa fa-home"></i> </a>

                @foreach ($menuCategory as $category)
                    <li>
                        <a href="{{ route("$moduleName/view", ['id' => $category->id]) }}">{{ $category->name }}</a>
                        @if ($category->chudes->isNotEmpty())
                            <ul class="sub-menu">
                                @foreach ($category->chudes as $chude)
                                    <li><a
                                            href="{{ route("$moduleName/view", ['id' => $chude->id, 'iddm' => $category->id]) }}">{{ $chude->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</div>
