<!-- Footer -->
<footer>
    <div class="bg2 p-t-40 p-b-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 p-b-20">
                    <div class="size-h-3 flex-s-c">
                        <a href="index.html">
                            <img style="width: 70px; height: 70px;" class="max-s-full" src="{{asset('https://stttt.khanhhoa.gov.vn/DATA/noimage.png')}}" alt="LOGO">
                        </a>
                    </div>

                    <div>
                        <p class="f1-s-1 cl11 p-b-16">
                            Địa chỉ: số 06 Trưng Nữ Vương, phường 1, thành phố Trà Vinh, tỉnh Trà Vinh.
                        </p>

                        <p class="f1-s-1 cl11 p-b-16">
                            Điện thoại 0294.3850856.
                        </p>

                        <div class="p-t-15">
                            <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                <span class="fab fa-facebook-f"></span>
                            </a>

                            <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                <span class="fab fa-twitter"></span>
                            </a>

                            <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                <span class="fab fa-pinterest-p"></span>
                            </a>

                            <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                <span class="fab fa-vimeo-v"></span>
                            </a>

                            <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                <span class="fab fa-youtube"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 p-b-20">
                    <div class="size-h-3 flex-s-c">
                        <h5 class="f1-m-7 cl0">
                            Popular Posts
                        </h5>
                    </div>

                    <ul>
                        @foreach ($Post as $post)
                            <li class="flex-wr-sb-s p-b-20">
                                <a href="#" class="size-w-4 wrap-pic-w hov1 trans-03">
                                    <img style="width: 90px; height: 80px; object-fit: cover; object-position: top;" src="{{ asset($fileUploadPath. $post->imageHash) }}" alt="IMG">
                                </a>

                                <div class="size-w-5">
                                    <h6 class="p-b-5">
                                        <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03">
                                            {{ $post->name }}
                                        </a>
                                    </h6>

                                    <span class="f1-s-3 cl6">
                                       {{ $post->created }}
                                    </span>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>

                <div class="col-sm-6 col-lg-4 p-b-20">
                    <div class="size-h-3 flex-s-c">
                        <h5 class="f1-m-7 cl0">
                            Category
                        </h5>
                    </div>

                    <ul class="m-t--12">
                        @foreach ($menuCategory as $key)
                            <li class="how-bor1 p-rl-5 p-tb-10">
                                <a href="{{ route("$moduleName/view", ['id' => $key->id]) }}"
                                    class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                    {{ $key->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="bg11">
        <div class="container size-h-4 flex-c-c p-tb-15">
            <span class="f1-s-1 cl0 txt-center">
                <a href="#"
                    class="f1-s-1 cl10 hov-link1"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved <i class="fa fa-heart" aria-hidden="true"></i> by NNT
                </a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </span>
        </div>
    </div>
</footer>
