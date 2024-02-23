@extends('user.danhmuc.submenu')
@section('danhmuc')
    <style>
        #postRow {
            display: flex;
        }

        #postRow .card {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
    </style>
    <section class="">
        <div class="container">

            <div class="row m-rl--1" id="postRow">
                <div class="col-md-3 p-rl-1 p-b-2 d-flex flex-column align-items-stretch">
                    <!-- Posts on the left -->
                    @foreach ($FourPosts->slice(1, 2) as $post)
                        <div class="card mb-3">
                            <div class="bg-img1 size-a-14 how1 pos-relative"
                                style="background-image: url({{ asset('hinhanh/' . $post->HinhAnh) }}); height: 150px">
                                <a href="{{ route('user.baiviet.detail', ['id' => $post->IDBV]) }}"
                                    class="dis-block how1-child1 trans-03"></a>
                            </div>
                            <div class="card-body">
                                <a href="#" style="font-size: 16px; color: #080808; font-weight: bold;">
                                    {{ $post->TenBV }}
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-6 p-rl-1 p-b-2 d-flex flex-column align-items-stretch">
                    <!-- Centered post -->
                    @if (isset($FourPosts[0]))
                        <div class="card mb-3">
                            <div class="bg-img1 size-a-3 how1 pos-relative"
                                style="background-image: url({{ asset('hinhanh/' . $FourPosts[0]->HinhAnh) }}); height: 366px">
                                <a href="{{ route('user.baiviet.detail', ['id' => $FourPosts[0]->IDBV]) }}"
                                    class="dis-block how1-child1 trans-03"></a>
                            </div>
                            <div class="card-body">
                                <a href="blog-detail-01.html" class=""
                                    style="font-size: 25px; color: #080808; font-weight: bold;">
                                    {{ $FourPosts[0]->TenBV }}
                                </a>
                            </div>

                        </div>
                    @endif
                </div>

                <div class="col-md-3 p-rl-1 p-b-2 d-flex flex-column align-items-stretch">
                    <!-- Posts on the right -->
                    @foreach ($FourPosts->slice(3, 2) as $post)
                        <div class="card mb-3">
                            <div class="bg-img1 size-a-14 how1 pos-relative"
                                style="background-image: url({{ asset('hinhanh/' . $post->HinhAnh) }}); height: 150px">
                                <a href="{{ route('user.baiviet.detail', ['id' => $post->IDBV]) }}"
                                    class="dis-block how1-child1 trans-03"></a>
                            </div>
                            <div class="card-body">
                                <a href="#" class=""
                                    style="font-size: 16px; ; color: #080808; font-weight: bold;">
                                    {{ $post->TenBV }}
                                </a>


                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <!-- Latest -->
    <div style="margin-top: 50px" class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="p-r-10 p-r-0-sr991">
                    <div class="how2 how2-cl4 flex-s-c">
                        <h3 class="f1-m-2 cl3 tab01-title">
                            Tin mới cập nhật
                        </h3>
                    </div>

                    <div class="row p-t-35">
                        <div class="">
                            <!-- Item latest -->
                            @foreach ($SixPostsNewUpdate as $post)
                                <!-- Item latest -->
                                <div style="margin-left: 15px" class="m-b-45 d-flex">
                                    <a href="{{ route('user.baiviet.detail', ['id' => $post->IDBV]) }}"
                                        class="wrap-pic-w hov1 trans-03">
                                        <img style="width: 250px; height: 160px; object-fit: cover; object-position: top;"
                                            src="{{ asset('hinhanh/' . $post->HinhAnh) }}" alt="IMG">
                                    </a>

                                    <div class="p-t-16 ml-3">
                                        <h5 class="p-b-5">
                                            <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                {{ $post->TenBV }}
                                            </a>
                                        </h5>

                                        <div>
                                            <span class="cl8">
                                                <a href="#" class="cl8">
                                                    {{ $post->Mota }}
                                                </a>
                                            </span>

                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-10 col-lg-4 p-b-50">
                <div class="p-l-10 p-rl-0-sr991">
                    <div class="p-l-10 p-rl-0-sr991 p-b-20">
                        <!--  -->

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
                                    <img src="{{ asset('hinhanh/lixi.png') }}" alt="Advertisement Image 1">
                                    <img src="{{ asset('hinhanh/c1.png') }}" alt="Advertisement Image 2">
                                    <img src="{{ asset('hinhanh/ngoisao.png') }}" alt="Advertisement Image 3">
                                    <!-- Add more images as needed -->
                                </div>
                            </div>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        /* Category box */
        .cate-news-24h-r {
            margin-top: 10px;
            margin-bottom: 50px;
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
            margin-bottom: 5px;
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
    <!-- tab cate-sub -->
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($CategoriesWithPosts as $category)
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
@endsection
