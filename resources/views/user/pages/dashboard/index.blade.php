@extends('layout')
@section('contentuser')

    @php
        $folderUpload = config('ntg.folderUpload.mainFolder');
        $fileUploadPath = '../' . $folderUpload . '/';
    @endphp

    @include("$moduleName.elements.login")
    @include("$moduleName.elements.signup")
    <div style="margin: 20px 18px 20px 0px">
        <div style="max-width: 1085px;" class="container">
            <div class="row">
                <div class="col-md-6 p-rl-6 p-b-2 ">
                    @if (isset($Post[0]))
                        @php
                            $PostTemp = $Post[0];
                            $imageUrl = in_array($PostTemp->imageHash, $imagesFTP) 
                            ? route('displayImages', ['fileName' => $PostTemp->imageHash])
                            : asset($fileUploadPath . $PostTemp->imageHash);
                        @endphp
                        <div class="bg-img1 size-a-3 how1 pos-relative "
                            style="background-image: url('{{ $imageUrl }}')">

                            <a href="{{ route("$moduleName/detail", ['id' => $PostTemp->id]) }}"
                                class="dis-block how1-child1 trans-03"></a>

                            <div class="flex-col-e-s s-full p-rl-25 p-tb-20 ">
                                <a href="#" style="box-shadow: inset;"
                                    class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                    {{ $PostTemp->chude->name }}
                                </a>

                                <h3 class="how1-child2 m-t-14 m-b-10">
                                    <a href="#" class=" hov-cl10 csstieude12">
                                        {{ $PostTemp->name }}
                                    </a>
                                </h3>

                                @php
                                    // Check if the content contains a video tag
                                    $hasVideo = strpos($PostTemp->content, '<video') !== false;
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
                            @if (isset($Post[1]))
                                @php
                                    $PostTemp = $Post[1];
                                    $imageUrl = in_array($PostTemp->imageHash, $imagesFTP) 
                                    ? route('displayImages', ['fileName' => $PostTemp->imageHash])
                                    : asset($fileUploadPath . $PostTemp->imageHash);
                                @endphp
                                <div class="bg-img1 size-a-4 how1 pos-relative"
                                    style="background-image: url('{{ $imageUrl }}')">

                                    <a href="{{ route("$moduleName/detail", ['id' => $PostTemp->id]) }}"
                                        class="dis-block how1-child1 trans-03"></a>

                                    @php
                                        // Check if the content contains a video tag
                                        $hasVideo = strpos($PostTemp->content, '<video') !== false;
                                    @endphp

                                    <div class="flex-col-e-s s-full p-rl-25 p-tb-24">
                                        <a href="{{ route("$moduleName/detail", ['id' => $PostTemp->id]) }}"
                                            class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                            {{ $PostTemp->chude->name }}
                                        </a>

                                        <h3 class="how1-child2 m-t-14">
                                            <a href="#"
                                                class="hov-cl10 csstieude12">
                                                {{ $PostTemp->name }}
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
                            @endif
                        </div>

                        @if (isset($Post[2]))
                            @php
                                $PostTemp = $Post[2];
                                $imageUrl = in_array($PostTemp->imageHash, $imagesFTP) 
                                    ? route('displayImages', ['fileName' => $PostTemp->imageHash])
                                    : asset($fileUploadPath . $PostTemp->imageHash);
                            @endphp
                            <div class="col-sm-6 p-rl-1 p-b-2">
                                <div class="bg-img1 size-a-5 how1 pos-relative"
                                    style="background-image: url('{{ $imageUrl }}')">
                                    <a href="{{ route("$moduleName/detail", ['id' => $Post[2]->id]) }}"
                                        class="dis-block how1-child1 trans-03"></a>

                                    @php
                                        // Check if the content contains a video tag
                                        $hasVideo = strpos($PostTemp->content, '<video') !== false;
                                    @endphp

                                    <div class="flex-col-e-s s-full p-rl-25 p-tb-20">
                                        <a href="#"
                                            class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                            {{ $PostTemp->chude->name }}
                                        </a>
                                        <h3 class="how1-child2 m-t-14">
                                            <a href="#"
                                                class="hov-cl10 csstieude34">
                                                {{ $PostTemp->name }}
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

                        @if (isset($Post[3]))
                            @php
                                $PostTemp = $Post[3];
                                $imageUrl = in_array($PostTemp->imageHash, $imagesFTP) 
                                ? route('displayImages', ['fileName' => $PostTemp->imageHash])
                                : asset($fileUploadPath . $PostTemp->imageHash);
                            @endphp
                            <div class="col-sm-6 p-rl-1 p-b-2">
                                <div class="bg-img1 size-a-5 how1 pos-relative"
                                    style="background-image: url('{{ $imageUrl }}')">

                                    <a href="{{ route("$moduleName/detail", ['id' => $PostTemp->id]) }}"
                                        class="dis-block how1-child1 trans-03"></a>

                                    @php
                                        // Check if the content contains a video tag
                                        $hasVideo = strpos($PostTemp->content, '<video') !== false;
                                    @endphp

                                    <div class="flex-col-e-s s-full p-rl-25 p-tb-20">
                                        <a href="#"
                                            class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                            {{ $PostTemp->chude->name }}
                                        </a>
                                        <h3 class="how1-child2 m-t-14">
                                            <a href="#"
                                                class="hov-cl10 csstieude34">
                                                {{ $PostTemp->name }}
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

    <!-- cate-sub -->
    <div style="max-width: 1122px;" class="container">
        <div style="padding: 0px" class="card">
            <div id="outputText" class="row justify-content-center">
                @foreach ($CategoriesWithPosts->take(4) as $category)
                    <div class="col-6 col-l">
                        <section style="height:500px " class="cate-news-24h-r coll-2 mar-t-40">
                            <div class="box-t d-flex align-items-center mar-b-15">
                                <header class="cate-news-24h-r__tit color-24h flex-auto pos-rel">
                                    <h2 class="fw-bold text-uppercase">
                                        <a style="color: #78B43D;"
                                            href=" {{ route("$moduleName/view", ['id' => $category->id]) }}"
                                            class="fw-bold text-uppercase color-24h">
                                            {{ $category->name }} </a>
                                    </h2>
                                </header>
                                <ul class="cate-news-24h-r_cate d-flex align-items-center">
                                    @if ($category->chudes->isNotEmpty())
                                        @foreach ($category->chudes->take(2) as $key => $chude)
                                            <li>
                                                <a href="{{ route("$moduleName/view", ['id' => $chude->id, 'iddm' => $chude->danhmucID]) }}"
                                                    class="hover-color-24h" style="color:#666666">
                                                    {{ $chude->name }} </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>

                                <li class="ml-auto">
                                    <a href="{{ route("$moduleName/view", ['id' => $category->id]) }}"
                                        class="all-subcategory">
                                        All &gt;
                                    </a>
                                </li>
                            </div>

                            {{-- menucardfirst --}}
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
                                                            href="{{ route("$moduleName/detail", ['id' => $baiviet->id]) }}">
                                                            <img style="width: 195px; height: 210px; object-fit: cover; object-position: top;"
                                                                src='{{ Storage::disk('ntg_storage')->exists('fileUpload/' . $baiviet->imageHash) ? asset('fileUpload/' . $baiviet->imageHash) : route('displayImages', ['fileName' => $baiviet->imageHash]) }}'
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
                                                                    {{ $baiviet->name }}
                                                                </a>

                                                                <a style="color: #252525;"
                                                                    class="d-block fw-medium hover-color-24h color-main"
                                                                    href="">
                                                                    {{ $baiviet->describe }}
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
                                                        <a href="{{ route("$moduleName/detail", ['id' => $baiviet->id]) }}"
                                                            style="color: inherit;">
                                                            {{ $baiviet->name }}
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
    </div>

    <!-- cate-sub-2 -->
    <div id="outputText" class="p-t-20">
        <div style="max-width: 1122px;" class="container">
            <div style="padding: 20px" class="card">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="p-b-20">
                            <!-- Entertainment -->
                            @foreach ($CategoriesWithPosts->take(2) as $category)
                                <div class="tab01 p-b-20">
                                    <div class="tab01-head how2 how2-cl1 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                                        <!-- Brand tab -->
                                        <h3 class="f1-m-2 cl12 tab01-title">
                                            <a href="#">{{ $category->name }}</a>
                                        </h3>
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            @if ($category->chudes->isNotEmpty())
                                                @foreach ($category->chudes->take(4) as $key => $chude)
                                                    <li class="nav-item">
                                                        <a class="nav-link {{ $key == 0 ? 'active' : '' }}"
                                                            href="{{ route("$moduleName/view", ['id' => $chude->id, 'iddm' => $chude->danhmucID]) }}">
                                                            {{ $chude->name }}
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

                                                            <a href="{{ route("$moduleName/detail", ['id' => $baiviet->id]) }}"
                                                                class="wrap-pic-w hov1 trans-03">
                                                                @if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $baiviet->imageHash))
                                                                    <img style="width: 195px; height: 210px; object-fit: cover; object-position: top;"
                                                                        src='{{ Storage::disk('ntg_storage')->exists('fileUpload/' . $baiviet->imageHash) ? asset('fileUpload/' . $baiviet->imageHash) : route('displayImages', ['fileName' => $baiviet->imageHash]) }}'>
                                                                @else
                                                                    <video
                                                                        style="width: 196px; height: 210px; object-fit: cover; object-position: top; position: absolute; top: 0; left: 0;">
                                                                        <source src="{{ $Post[0]->imageHash }}"
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
                                                                        href="{{ route("$moduleName/detail", ['id' => $baiviet->id]) }}">
                                                                        {{ $baiviet->name }}
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
                            <!-- Xem nhiều-->
                            @include("$moduleName.elements.viewest")
                            @include("$moduleName.elements.ads")

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest -->
    <div class="p-t-20 p-b-35">
        <div style="max-width: 1122px;" class="container">
            <div style="padding: 20px" class="card">
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
                                @foreach ($Post->take(3) as $post)
                                    <!-- Item latest -->
                                    <div class="m-b-45">
                                        <a href="{{ route("$moduleName/detail", ['id' => $post->id]) }}"
                                            class="wrap-pic-w hov1 trans-03">
                                            <img style="width: 300px; height: 250px; object-fit: cover; object-position: top;"
                                                src="{{ asset($fileUploadPath . $post->imageHash) }}" alt="IMG">
                                        </a>

                                        <div class="p-t-16">
                                            <h5 class="p-b-5">
                                                <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                    {{ $post->name }}
                                                </a>
                                            </h5>
                                            <span class="f1-s-3 cl6">
                                                {{ \Carbon\Carbon::parse($post->created)->format('d/m/Y') }}
                                            </span>

                                            <span class="cl8 ml-2">
                                                <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                    {{ $post->admin->name }}
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                <!-- Item latest -->
                                @foreach ($Post->slice(3) as $post)
                                    <div class="m-b-45">
                                        <a href="{{ route("$moduleName/detail", ['id' => $post->id]) }}"
                                            class="wrap-pic-w hov1 trans-03">
                                            <img style="width: 300px; height: 250px; object-fit: cover; object-position: top;"
                                                src="{{ asset($fileUploadPath . $post->imageHash) }}" alt="IMG">
                                        </a>

                                        <div class="p-t-16">
                                            <h5 class="p-b-5">
                                                <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                    {{ $post->name }}
                                                </a>
                                            </h5>
                                            <span class="f1-s-3 cl6">
                                                {{ \Carbon\Carbon::parse($post->created)->format('d/m/Y') }}
                                            </span>
                                            <span class="cl6 ml-2">
                                                <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                    {{ $post->admin->name }}
                                                </a>
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
                                        Chủ đề
                                    </h3>
                                </div>

                                <div class="flex-wr-s-s m-rl--5">
                                    @foreach ($subCategory as $key)
                                        <a href="{{ route("$moduleName/view", ['id' => $key->id]) }}"
                                            class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                            {{ $key->name }}
                                        </a>
                                    @endforeach
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
                                        <a href="{{ route("$moduleName/view", ['id' => $key->id]) }}"
                                            class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                            {{ $key->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="dim-overlay"></div>
@endsection
