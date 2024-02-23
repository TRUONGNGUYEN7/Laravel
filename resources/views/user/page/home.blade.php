@extends('layout')
@section('contentuser')
    <style>
        .csstieude12 {
            background-color: #000000bd;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            display: table;
            font-size: 20px;
        }

        .csstieude12:hover {
            background-color: black;
        }

        .csstieude34 {
            background-color: #00000094;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            display: block;

            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            max-width: 230px;
        }

        .csstieude34:hover {
            background-color: black;
        }

        .fontsizebv {
            font-size: 17px;
        }

        /* Main container */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
            /* Add negative margin to account for column padding */
        }

        /* Left and Right columns */
        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 15px;
        }

        /* Category box */
        .cate-news-24h-r {
            margin-top: 40px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }

        /* Category title */
        .cate-news-24h-r__tit h2 {
            color: #78B43D;
            font-weight: bold;
            text-transform: uppercase;
            padding: 15px;
            margin: 0;
            border-bottom: 1px solid #e0e0e0;
        }

        /* Style the header section */
        .box-t {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .cate-news-24h-r__tit {
            color: #24B43D;
            /* Change the color as needed */
            margin-right: 15px;
        }

        .cate-news-24h-r_cate {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .cate-news-24h-r_cate li {
            margin-right: 15px;
            /* Adjust the spacing between list items as needed */
        }
    </style>

    <!-- Feature post -->
    <div style="margin-top: 20px">
        <div class="container ">
            <div class="row m-rl--1 ">

                <div class="col-md-6 p-rl-6 p-b-2 ">
                    @if (isset($FourPosts[0]))
                        <div class="bg-img1 size-a-3 how1 pos-relative "
                            style="background-image: url({{ asset('hinhanh/' . $FourPosts[0]->HinhAnh) }}); width: 98%">
                            <a href="{{ route('user.baiviet.detail', ['id' => $FourPosts[0]->IDBV]) }}"
                                class="dis-block how1-child1 trans-03"></a>


                            <div class="flex-col-e-s s-full p-rl-25 p-tb-20 ">
                                <a href="#" style="box-shadow: inset;"
                                    class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                    {{ $FourPosts[0]->TenChuDe }}
                                </a>

                                <h3 class="how1-child2 m-t-14 m-b-10">
                                    <a href="#" class="csstieude12 how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">
                                        {{ $FourPosts[0]->TenBV }}
                                    </a>
                                </h3>

                                <style>
                                    @keyframes blink {
                                        100% {
                                            color: rgb(241, 63, 63);
                                            /* or specify the ending color */
                                        }
                                    }

                                    .play-button {
                                        animation: blink 2s infinite;
                                        /* Adjust the duration as needed */
                                    }
                                </style>

                                @php
                                    // Check if the NoiDung contains a video tag
                                    $hasVideo = strpos($FourPosts[0]->NoiDung, '<video') !== false;
                                @endphp

                                @if ($hasVideo) <!-- Play button overlay -->
                                    <div class="play-container"
                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;">
                                        <button class="play-button"
                                            style="color: blue; font-size: 3em; border: none; padding: 10px 20px; cursor: pointer;">
                                            <i class="fas fa-play"></i>
                                        </button>
                                    </div> @endif
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-6 p-rl-1">
                    <div class="row m-rl--1">
                        <div class="col-12 p-rl-1 p-b-2">
                            <div class="bg-img1 size-a-4 how1 pos-relative"
                                style="background-image: url({{ asset('hinhanh/' . $FourPosts[1]->HinhAnh) }});">
                                <a href="{{ route('user.baiviet.detail', ['id' => $FourPosts[1]->IDBV]) }}"
                                    class="dis-block how1-child1 trans-03"></a>

                                @php
                                    // Check if the Noidung contains a video tag
                                    $hasVideo = strpos($FourPosts[1]->NoiDung, '<video') !== false;
                                @endphp

                                <div class="flex-col-e-s s-full p-rl-25 p-tb-24">
                                    <a href="{{ route('user.baiviet.detail', ['id' => $FourPosts[1]->IDBV]) }}"
                                        class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                        {{ $FourPosts[1]->TenChuDe }}
                                    </a>

                                    <h3 class="how1-child2 m-t-14">
                                        <a href="#"
                                            class="how-txt1 size-a-7 f1-l-2 cl0 hov-cl10 trans-03 csstieude12">
                                            {{ $FourPosts[1]->TenBV }}
                                        </a>
                                    </h3>

                                    @if ($hasVideo)
                                        <!-- Play button overlay -->
                                        <div class="play-container"
                                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1; font-size: 27px">
                                            <button class="play-button">
                                                <i class="fas fa-play"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if (isset($FourPosts[2]))
                            <div class="col-sm-6 p-rl-1 p-b-2">
                                <div class="bg-img1 size-a-5 how1 pos-relative"
                                    style="background-image: url({{ asset('hinhanh/' . $FourPosts[2]->HinhAnh) }});">
                                    <a href="{{ route('user.baiviet.detail', ['id' => $FourPosts[2]->IDBV]) }}"
                                        class="dis-block how1-child1 trans-03"></a>

                                    @php
                                        // Check if the Noidung contains a video tag
                                        $hasVideo = strpos($FourPosts[2]->NoiDung, '<video') !== false;
                                    @endphp

                                    <div class="flex-col-e-s s-full p-rl-25 p-tb-20">
                                        <a href="#"
                                            class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                            {{ $FourPosts->isEmpty() ? 'No Category' : $FourPosts[2]->TenChuDe }}
                                        </a>
                                        <h3 class="how1-child2 m-t-14">
                                            <a href="#"
                                                class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03 csstieude34">
                                                {{ $FourPosts->isEmpty() ? 'No Title' : $FourPosts[2]->TenBV }}
                                            </a>
                                        </h3>

                                        @if ($hasVideo)
                                            <!-- Play button overlay -->
                                            <div class="play-container"
                                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;">
                                                <button class="play-button">
                                                    <i class="fas fa-play"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        @endif

                        @if (isset($FourPosts[3]))
                            <div class="col-sm-6 p-rl-1 p-b-2">
                                <div class="bg-img1 size-a-5 how1 pos-relative"
                                    style="background-image: url({{ asset('hinhanh/' . $FourPosts[3]->HinhAnh) }});">
                                    <a href="{{ route('user.baiviet.detail', ['id' => $FourPosts[3]->IDBV]) }}"
                                        class="dis-block how1-child1 trans-03"></a>

                                    @php
                                        // Check if the Noidung contains a video tag
                                        $hasVideo = strpos($FourPosts[3]->NoiDung, '<video') !== false;
                                    @endphp

                                    <div class="flex-col-e-s s-full p-rl-25 p-tb-20">
                                        <a href="#"
                                            class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                            {{ $FourPosts->isEmpty() ? 'No Category' : $FourPosts[3]->TenChuDe }}
                                        </a>
                                        <h3 class="how1-child2 m-t-14">
                                            <a href="#"
                                                class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03 csstieude34">
                                                {{ $FourPosts->isEmpty() ? 'No Title' : $FourPosts[3]->TenBV }}
                                            </a>
                                        </h3>

                                        @if ($hasVideo)
                                            <!-- Play button overlay -->
                                            <div class="play-container"
                                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;">
                                                <button class="play-button">
                                                    <i class="fas fa-play"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- tab cate-sub -->
    <div class="container">
        <div id="outputText" class="row justify-content-center">
            @foreach ($CategoriesWithPosts->take(4) as $category)
                <div class="col-6 col-l">
                    <section style="height:500px " class="cate-news-24h-r coll-2 mar-t-40">
                        <div class="box-t d-flex align-items-center mar-b-15">
                            <header class="cate-news-24h-r__tit color-24h flex-auto pos-rel">
                                <h2 class="fw-bold text-uppercase">
                                    <a style="color: #78B43D;"
                                        href=" {{ route('user.hienthi', ['id' => $category->IDDM]) }}"
                                        class="fw-bold text-uppercase color-24h">
                                        {{ $category->TenDanhMuc }} </a>
                                </h2>
                            </header>
                            <ul class="cate-news-24h-r_cate d-flex align-items-center">
                                @if ($category->chudes->isNotEmpty())
                                    @foreach ($category->chudes->take(2) as $key => $chude)
                                        <li>
                                            <a href="{{ route('user.hienthi', ['id' => $chude->IDCD, 'iddm' => $chude->DanhMucID]) }}"
                                                class="hover-color-24h" style="color:#666666">
                                                {{ $chude->TenChuDe }} </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>

                            <li class="ml-auto">
                                <a href="{{ route('user.hienthi', ['id' => $category->IDDM]) }}" class="all-subcategory">
                                    All &gt;
                                </a>
                            </li>
                        </div>

                        <div class="container">
                            <!-- First row -->
                            <div class="row">
                                <div class="col-6">
                                    <!-- Large article with image and description -->
                                    <article class="cate-news-24h-r-big border-right pr-3 ">
                                        <!-- Image -->
                                        @if ($category->chudes->isNotEmpty())
                                            @foreach ($category->chudes->first()->baiviets->take(1) as $baiviet)
                                                <figure class="cate-news-24h-r-big__img pos-rel mar-b-15">
                                                    <a onclick=""
                                                        href="{{ route('user.baiviet.detail', ['id' => $baiviet->IDBV]) }}">
                                                        <img style="width: 195px; height: 210px; object-fit: cover; object-position: top;"
                                                            src='{{ asset("hinhanh/$baiviet->HinhAnh") }}'
                                                            class="width-100 loaded" data-was-processed="true">
                                                    </a>
                                                </figure>

                                                <!-- Article Information -->
                                                <div class="cate-news-24h-r-big__info">
                                                    <header class="cate-news-24h-r-big__tit mar-b-5">
                                                        <h3>
                                                            <a style="color: black; font-weight: bold; font-size: 18px;"
                                                                class="d-block fw-medium hover-color-24h color-main"
                                                                href="">
                                                                {{ $baiviet->TenBV }}
                                                            </a>

                                                            <a style="color: #252525;"
                                                                class="d-block fw-medium hover-color-24h color-main"
                                                                href="">
                                                                {{ $baiviet->Mota }}
                                                            </a>
                                                        </h3>
                                                    </header>
                                                </div>
                                            @endforeach
                                        @endif
                                    </article>
                                </div>

                                <div class="col-6">
                                    <div class="content-on-right border-left pl-3"
                                        style="color: black; text-indent: -20px; line-height: 1.4;">
                                        @if ($category->chudes->isNotEmpty())
                                            @foreach ($category->chudes->flatMap->baiviets->slice(1) as $baiviet)
                                                <p style="margin-bottom: 10px;">
                                                    🔹
                                                    <a href="{{ route('user.baiviet.detail', ['id' => $baiviet->IDBV]) }}"
                                                        style="color: inherit;">
                                                        {{ $baiviet->TenBV }}
                                                    </a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            @endforeach
        </div>

    </div>

    {{-- <!-- category -->
    <div id="outputText" class="p-t-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="p-b-20">
                        <!-- Entertainment -->
                        @foreach ($CategoriesWithPosts->take(2) as $category)
                            <div class="tab01 p-b-20">
                                <div class="tab01-head how2 how2-cl1 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                                    <!-- Brand tab -->
                                    <h3 class="f1-m-2 cl12 tab01-title">
                                        <a href="#">{{ $category->TenDanhMuc }}</a>
                                    </h3>
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        @if ($category->chudes->isNotEmpty())
                                            @foreach ($category->chudes->take(4) as $key => $chude)
                                                <li class="nav-item">
                                                    <a class="nav-link {{ $key == 0 ? 'active' : '' }}"
                                                        href="{{ route('user.hienthi', ['id' => $chude->IDCD, 'iddm' => $chude->DanhMucID]) }}">
                                                        {{ $chude->TenChuDe }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <a href="#" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
                                        View all
                                        <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                    </a>
                                </div>

                                <!-- Tab panes -->
                                <div class="tab-content p-t-35">
                                    <div class="tab-pane fade show active" id="allTopics" role="tabpanel">
                                        <div class="row">
                                            @foreach ($category->chudes->flatMap->baiviets->take(6) as $baiviet)
                                                <div class="col-sm-4 p-r-25 p-r-15-sr991">
                                                    <!-- Item post -->
                                                    <div class="m-b-30">
                                                        <a href="{{ route('user.baiviet.detail', ['id' => $baiviet->IDBV]) }}"
                                                            class="wrap-pic-w hov1 trans-03">
                                                            @if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $baiviet->HinhAnh))
                                                                <img style="width: 195px; height: 210px; object-fit: cover; object-position: top;"
                                                                    src='{{ asset("hinhanh/$baiviet->HinhAnh") }}'>
                                                            @else
                                                                <video
                                                                    style="width: 196px; height: 210px; object-fit: cover; object-position: top; position: absolute; top: 0; left: 0;">
                                                                    <source src="{{ $FourPosts[0]->HinhAnh }}"
                                                                        type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                                <!-- Play button overlay -->
                                                                <div
                                                                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1;">
                                                                    <button
                                                                        style="font-size: 3em; border: none; padding: 10px 20px; cursor: pointer;">
                                                                        ▶️
                                                                    </button>
                                                                </div>
                                                            @endif

                                                        </a>



                                                        <div class="p-t-20">
                                                            <h6 class="p-b-5">
                                                                <a class="fontsizebv f1-m-3 cl2 hov-cl10 trans-03"
                                                                    href="{{ route('user.baiviet.detail', ['id' => $baiviet->IDBV]) }}">
                                                                    {{ $baiviet->TenBV }}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>



                <div class="col-md-10 col-lg-4">
                    <div class="p-l-10 p-rl-0-sr991 p-b-20">
                        <!--  -->
                        <div>
                            <div class="how2 how2-cl4 flex-s-c">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Xem nhiều
                                </h3>
                            </div>
                            <ul class="p-t-35">
                                @foreach ($viewPost as $post)
                                    <li class="flex-wr-sb-s p-b-29">
                                        <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
                                            {{ $loop->index + 1 }}
                                        </div>
                                        <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                            {{ $post->TenBV }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <style>
                            .banner-container {
                                overflow: hidden;
                            }

                            .banner-images {
                                display: flex;
                                transition: transform 1s ease-in-out;
                                width: 1020px;
                                /* Total width of three images (250px each) */
                                height: 530px;
                            }

                            .banner-images img {
                                width: 340px;
                                height: 530px;
                                margin-right: 20px;

                            }
                        </style>


                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const bannerImages = document.querySelector('.banner-images');
                                const images = document.querySelectorAll('.banner-images img');

                                let currentIndex = 0;

                                function showNextImage() {
                                    currentIndex = (currentIndex + 1) % images.length;
                                    const translateValue = -currentIndex * 340;
                                    bannerImages.style.transform = `translateX(${translateValue}px)`;
                                }

                                setInterval(function() {
                                    showNextImage();
                                    setTimeout(function() {
                                        bannerImages.style.transition = 'none';
                                        setTimeout(function() {
                                            bannerImages.style.transition = 'transform 1s ease-in-out';
                                        }, 10);
                                    }, 3000);
                                }, 6000);
                            });
                        </script>

                        <div>
                            <div class="how2 how2-cl4 flex-s-c">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Quảng cáo
                                </h3>
                            </div>
                            <ul class="p-t-35">

                                <!-- Banner ads content goes here -->
                                <div class="banner-container">
                                    <div class="banner-images">
                                        <img src="hinhanh/lixi.png" alt="Advertisement Image 1">
                                        <img src="hinhanh/c1.png" alt="Advertisement Image 2">
                                        <img src="hinhanh/ngoisao.png" alt="Advertisement Image 3">
                                        <!-- Add more images as needed -->
                                    </div>
                                </div>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Latest -->
    <div class="p-t-60 p-b-35">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 p-b-20">
                    <div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991">
                        <h3 class="f1-m-2 cl3 tab01-title">
                            Tin mới cập nhật
                        </h3>
                    </div>

                    <div class="row p-t-35">
                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                            <!-- Item latest -->
                            @foreach ($SixPostsNewUpdate->take(3) as $post)
                                <!-- Item latest -->
                                <div class="m-b-45">
                                    <a href="{{ route('user.baiviet.detail', ['id' => $post->IDBV]) }}"
                                        class="wrap-pic-w hov1 trans-03">
                                        <img style="width: 300px; height: 250px; object-fit: cover; object-position: top;"
                                            src="{{ asset('hinhanh/' . $post->HinhAnh) }}" alt="IMG">
                                    </a>

                                    <div class="p-t-16">
                                        <h5 class="p-b-5">
                                            <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                {{ $post->TenBV }}
                                            </a>
                                        </h5>

                                        <span class="cl8">
                                            <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                {{ $post->NguoiDangBV }}
                                            </a>

                                            <span class="f1-s-3 m-rl-3">
                                                -
                                            </span>

                                            <span class="f1-s-3">
                                                {{ $post->ThoiGianBV }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                            <!-- Item latest -->
                            @foreach ($SixPostsNewUpdate->slice(3) as $post)
                                <div class="m-b-45">
                                    <a href="{{ route('user.baiviet.detail', ['id' => $post->IDBV]) }}"
                                        class="wrap-pic-w hov1 trans-03">
                                        <img style="width: 300px; height: 250px; object-fit: cover; object-position: top;"
                                            src="{{ asset('hinhanh/' . $post->HinhAnh) }}" alt="IMG">
                                    </a>

                                    <div class="p-t-16">
                                        <h5 class="p-b-5">
                                            <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                {{ $post->TenBV }}
                                            </a>
                                        </h5>

                                        <span class="cl8">
                                            <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                {{ $post->NguoiDangBV }}
                                            </a>

                                            <span class="f1-s-3 m-rl-3">
                                                -
                                            </span>

                                            <span class="f1-s-3">
                                                {{ $post->ThoiGianBV }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="col-md-10 col-lg-4">
                    <div class="p-l-10 p-rl-0-sr991 p-b-20">
                        <!-- Video -->
                        <div class="p-b-55">
                            <div class="how2 how2-cl4 flex-s-c m-b-35">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Featured Video
                                </h3>
                            </div>

                            <div>
                                <div class="wrap-pic-w pos-relative">
                                    <img src="{{ asset('hinhanh/lixi.png') }}" alt="IMG">

                                    <button class="s-full ab-t-l flex-c-c fs-32 cl0 hov-cl10 trans-03" data-toggle="modal"
                                        data-target="#modal-video-01">
                                        <span class="fab fa-youtube"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Tag -->
                        <div>
                            <div class="how2 how2-cl4 flex-s-c m-b-30">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Danh mục
                                </h3>
                            </div>

                            <div class="flex-wr-s-s m-rl--5">
                                @foreach ($menuCategory as $key)
                                    <a href="{{ route('user.hienthi', ['id' => $key->IDDM]) }}"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        {{ $key->TenDanhMuc }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
