@extends('layout')
@section('detail')
    <!-- Content -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .noidung {
            max-width: 100%;
            height: auto;
            vertical-align: middle;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }
    </style>
    <section class="bg0 p-b-140 p-t-10">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 p-b-30">
                    <div class="p-r-10 p-r-0-sr991">
                        <!-- Blog Detail -->
                        @if ($ttbaiviet)
                            <div class="p-b-70">

                                <h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
                                    {{ $ttbaiviet->TenBV }}
                                </h3>

                                <div class="flex-wr-s-s p-b-40">
                                    <span class="f1-s-3 cl8 m-r-15">
                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                            {{ $ttbaiviet->NguoiDangBV }}
                                        </a>
                                        <span class="m-rl-3">-</span>
                                        <span>
                                            {{ $ttbaiviet->ThoiGianBV }}
                                        </span>
                                    </span>

                                    <span class="f1-s-3 cl8 m-r-15">
                                        {{ $ttbaiviet->LuotXem }} Views
                                    </span>

                                    <a href="#" class="f1-s-3 cl8 hov-cl10 trans-03 m-r-15">
                                        0 Comment
                                    </a>
                                </div>

                                <p class="f1-s-11 cl6 p-b-25">
                                    {{ $ttbaiviet->Mota }}
                                </p>
                                <div class="noidung">
                                    <?php
                                    $content = $ttbaiviet->NoiDung;
                                    
                                    // Check if the content contains images or videos
                                    if (preg_match_all('/<(img|iframe|video)[^>]+>/i', $content, $matches)) {
                                        $mediaElements = $matches[0];
                                    
                                        // Apply styling to each image, iframe, or video
                                        foreach ($mediaElements as $mediaElement) {
                                            if (strpos($mediaElement, '<video') !== false) {
                                                // If it's a video, add the autoplay attribute
                                                $styledMediaElement = str_replace('<video', '<video autoplay style="max-width:100%; height:auto; border: 1px solid #061041"', $mediaElement);
                                            } else {
                                                // For images and iframes, apply styling
                                                $styledMediaElement = str_replace('<' . $matches[1][0], '<' . $matches[1][0] . ' style="max-width:670px; height:auto;"', $mediaElement);
                                            }
                                            $content = str_replace($mediaElement, $styledMediaElement, $content);
                                        }
                                    }
                                    
                                    // Apply styling to paragraphs
                                    $content = str_replace('<p>', '<p style="margin-bottom: -15px; margin-left: 1px">', nl2br($content));
                                    
                                    echo '<div style="line-height:;">' . $content . '</div>';
                                    ?>
                                </div>

                                <script>
                                    window.onload = function() {
                                        // Find the video element within the noidung div
                                        var videoElement = document.querySelector('.noidung video');

                                        if (videoElement) {
                                            // Get the offsetTop of the video element
                                            var offsetTop = videoElement.offsetTop;

                                            // Scroll to the position of the video element with a smooth scroll effect
                                            window.scrollTo({
                                                top: offsetTop,
                                                behavior: 'smooth' // Use 'auto' for immediate scrolling
                                            });
                                        }
                                    };
                                </script>


                                <br>
                                <!-- Tag -->
                                <div class="flex-s-s p-t-12 p-b-15">

                                </div>

                            </div>
                        @else
                            Bài viết không tồn tại
                        @endif
                        <!-- Leave a comment -->
                        <div>
                            <h4 class="f1-l-4 cl3 p-b-12">
                                Để lại một bình luận
                            </h4>

                            <p class="f1-s-13 cl8 p-b-40">
                                Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh
                                dấu *
                            </p>

                            <!-- jQuery CDN -->
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <!-- SweetAlert CDN (SweetAlert2) -->
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                            <form id="form-comment">
                                {{ csrf_field() }}
                                <textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" name="noidung" id="noidung"
                                    placeholder="Comment..." onclick="checkAndShowPopup()"></textarea>

                                <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="email"
                                    name="email" placeholder="Email*">

                                <input type="submit" id="button-comment" value="Đăng">
                            </form>

                            <script>
                                $(document).ready(function() {
                                    var userData = @json(session('user_data'));

                                    $('#form-comment').on('submit', function(e) {
                                        e.preventDefault();

                                        // Validate input fields
                                        var noidungValue = $('#noidung').val();
                                        var emailValue = $('input[name="email"]').val();

                                        // Proceed with the AJAX request
                                        var formData = $(this).serialize();

                                        if (userData && userData.user_username) {
                                            if (!noidungValue || !emailValue) {
                                                return; // Kết thúc hàm khi có lỗi
                                            } else {
                                                var url =
                                                    "{{ route('user.comment.add', ['id' => ':user_id']) }}";
                                                url = url.replace(':user_id', userData.user_id);

                                                $.ajax({
                                                    url: url,
                                                    type: 'POST',
                                                    headers: {
                                                        'X-CSRF-TOKEN': $(
                                                            'meta[name="csrf-token"]'
                                                        ).attr('content')
                                                    },
                                                    data: formData,
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        if (data.success) {
                                                            alert(
                                                                'Bình luận thành công'
                                                            );
                                                            // Reset input fields
                                                            $('#noidung').val(
                                                                '');
                                                            $('input[name="name"]')
                                                                .val('');
                                                            $('input[name="email"]')
                                                                .val('');
                                                        } else {
                                                            alert(
                                                                'Toàn khoản hoặc mật khẩu không đúng.'
                                                            );
                                                        }
                                                    },
                                                    error: function(xhr, status,
                                                        error) {
                                                        console.error('Error:',
                                                            xhr
                                                            .responseText);
                                                        alert(
                                                            'Error during login. Please try again.'
                                                        );
                                                    }
                                                });
                                            }
                                        } else {

                                            checkAndShowPopup();
                                        }
                                    });

                                });
                            </script>

                            <script>
                                $(document).ready(function() {
                                    var userData = @json(session('user_data'));

                                    if (userData && userData.user_username) {
                                        $('#button-comment').show();
                                    }

                                    $('#form-comment').on('submit', function(e) {
                                        e.preventDefault();

                                        // Validate input fields
                                        var noidungValue = $('#noidung').val();
                                        var emailValue = $('input[name="email"]').val();


                                        // Proceed with the AJAX request
                                        var formData = $(this).serialize();

                                        if (userData && userData.user_username) {

                                            if (!noidungValue || !emailValue) {
                                                alert('Điền đây đủ thông tin.');
                                                return;
                                            } else {
                                                var url =
                                                    "{{ route('user.comment.add', ['id' => ':user_id']) }}";
                                                url = url.replace(':user_id', userData.user_id);

                                                $.ajax({
                                                    url: url,
                                                    type: 'POST',
                                                    headers: {
                                                        'X-CSRF-TOKEN': $(
                                                            'meta[name="csrf-token"]'
                                                        ).attr('content')
                                                    },
                                                    data: formData,
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        if (data.success) {
                                                            alert(
                                                                'Bình luận thành công'
                                                            );
                                                        } else {
                                                            alert(
                                                                'Toàn khoản hoặc mật khẩu không đúng.'
                                                            );
                                                        }
                                                    },
                                                    error: function(xhr, status,
                                                        error) {
                                                        console.error('Error:',
                                                            xhr
                                                            .responseText);
                                                        alert(
                                                            'Error during login. Please try again.'
                                                        );
                                                    }
                                                });
                                            }

                                        } else {
                                            // User is not authenticated, show an alert or redirect to the login page
                                            alert('Bạn cần đăng nhập trước khi thêm bình luận.');
                                            // Alternatively, you can redirect the user to the login page
                                            checkAndShowPopup();
                                        }
                                    });
                                });
                            </script>

                            {{-- show popup login --}}
                            <script>
                                function checkAndShowPopup() {
                                    @if (session('user_data') && session('user_data')['user_username'])
                                        // Nếu đã đăng nhập, không làm gì cả
                                    @else

                                        document.getElementById('login-form-wrap').style.display = 'block';
                                    @endif
                                }
                            </script>

                        </div>

                        <div id="login-form-wrap">
                            <div class="login-header">
                                <h1 style="font-size: 20px">Login</h1>
                                <button onclick="document.getElementById('login-form-wrap').style.display = 'none';"
                                    class="close-button">&times;</button>
                            </div>

                            <form id="login-form">
                                {{ csrf_field() }}
                                <p>
                                    <input type="text" id="name" name="name" onfocus="checkAndShowPopup()"
                                        placeholder="Username" required>
                                    <i class="validation"></i>
                                </p>
                                <p>
                                    <input type="text" id="password" name="password" placeholder="Password" required>
                                    <i class="validation"></i>
                                </p>
                                <p>
                                    <input type="submit" id="login" value="Login">
                                </p>
                            </form>
                            <div id="create-account-wrap">
                                <p>Not a member? <a href="{{ route('user.signup') }}">Create Account</a></p>
                            </div>

                        </div>

                        <script>
                            $('#login-form').on('submit', function(e) {
                                e.preventDefault();
                                // Perform AJAX request
                                $.ajax({
                                    url: "{{ route('user.signin_action') }}",
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: $(this).serialize(),
                                    dataType: 'json',
                                    success: function(data) {
                                        if (data.success) {
                                            $('#login-form-wrap').hide();
                                            location.reload();
                                        } else {
                                            alert('Tài khoản hoặc mật khẩu không đúng.');
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error:', xhr.responseText);
                                        alert('Error during login. Please try again.');
                                    }
                                });
                            });
                        </script>

                        <style>
                            #login-form-wrap {
                                display: none;
                                position: fixed;
                                top: 65%;
                                left: 40%;
                                width: 82%;
                                max-width: 505px;
                                height: 45%;
                                margin-top: -15%;
                                /* Duy trì vị trí trung tâm */
                                background-color: #fff;
                                text-align: center;
                                transform: translate(-50%, -50%);
                                z-index: 999;
                                padding: 20px 0 0 0;
                                border-radius: 4px;
                                box-shadow: 2px 14px 30px 20px rgba(0, 0, 0, 0.2);
                            }

                            .login-header {
                                display: inline-flex;
                                justify-content: space-between;
                                align-items: center;
                                margin-bottom: 0px;
                            }

                            .close-button {
                                background-color: transparent;
                                border: none;
                                color: #333;
                                font-size: 28px;
                                cursor: pointer;
                                margin-left: 290%;
                                /* Điều chỉnh tùy theo vị trí mong muốn */
                                margin-top: -12px;
                                z-index: 999;
                            }

                            .close-button:hover {
                                color: #e81818;
                            }

                            #login-form {
                                padding: 0 20px;
                                /* Điều chỉnh theo nhu cầu */
                                margin-top: 60px;
                            }

                            input {
                                display: block;
                                box-sizing: border-box;
                                width: 100%;
                                outline: none;
                                height: 40px;
                                /* Điều chỉnh chiều cao của input */
                                line-height: 40px;
                                border-radius: 4px;
                                margin-bottom: 25px;
                            }


                            input[type="text"],
                            input[type="email"] {
                                width: 100%;
                                padding: 0 0 0 10px;
                                margin: 0;
                                color: #8a8b8e;
                                border: 1px solid #c2c0ca;
                                font-style: normal;
                                font-size: 16px;
                                -webkit-appearance: none;
                                -moz-appearance: none;
                                appearance: none;
                                position: relative;
                                display: inline-block;
                                background: none;
                                margin-bottom: 40px;
                                font-size: 15px;
                            }

                            input[type="text"]:focus,
                            input[type="email"]:focus {
                                border-color: #3ca9e2;
                            }

                            input[type="text"]:focus:invalid,
                            input[type="email"]:focus:invalid {
                                color: #cc1e2b;
                                border-color: #cc1e2b;
                            }

                            input[type="text"]:valid~.validation,
                            input[type="email"]:valid~.validation {
                                display: block;
                                border-color: #0C0;
                            }

                            input[type="text"]:valid~.validation span,
                            input[type="email"]:valid~.validation span {
                                background: #0C0;
                                position: absolute;
                                border-radius: 6px;
                            }

                            input[type="text"]:valid~.validation span:first-child,
                            input[type="email"]:valid~.validation span:first-child {
                                top: 30px;
                                left: 14px;
                                width: 20px;
                                height: 3px;
                                -webkit-transform: rotate(-45deg);
                                transform: rotate(-45deg);
                            }

                            input[type="text"]:valid~.validation span:last-child,
                            input[type="email"]:valid~.validation span:last-child {
                                top: 35px;
                                left: 8px;
                                width: 11px;
                                height: 3px;
                                -webkit-transform: rotate(45deg);
                                transform: rotate(45deg);
                            }

                            .validation {
                                display: none;
                                position: absolute;
                                content: " ";
                                height: 60px;
                                width: 30px;
                                right: 15px;
                                top: 0px;
                            }

                            input[type="submit"] {
                                border: none;
                                display: block;
                                background-color: #3ca9e2;
                                color: #fff;
                                font-weight: bold;
                                text-transform: uppercase;
                                cursor: pointer;
                                -webkit-transition: all 0.2s ease;
                                transition: all 0.2s ease;
                                font-size: 18px;
                                position: relative;
                                display: inline-block;
                                cursor: pointer;
                                text-align: center;
                            }

                            input[type="submit"]:hover {
                                background-color: #0474b5;
                                -webkit-transition: all 0.2s ease;
                                transition: all 0.2s ease;
                            }

                            #create-account-wrap {
                                background-color: #eeedf1;
                                color: #8a8b8e;
                                font-size: 14px;
                                width: 100%;
                                padding: 10px 0;
                                border-radius: 0 0 4px 4px;
                            }
                        </style>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="col-md-10 col-lg-4 p-b-30">
                    <div class="p-l-10 p-rl-0-sr991 p-t-70">

                        <!-- Popular Posts -->
                        <div class="p-b-30">
                            <div class="how2 how2-cl4 flex-s-c">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Xem nhiều
                                </h3>
                            </div>

                            <ul class="p-t-35">
                                <li class="flex-wr-sb-s p-b-30">
                                    @foreach ($viewPost as $key)
                                        <a href="#" class="size-w-10 wrap-pic-w hov1 trans-03">
                                            <img style="margin-bottom: 10px" src='{{ asset("hinhanh/$key->HinhAnh") }}'
                                                alt="IMG">
                                        </a>

                                        <div class="size-w-11">
                                            <h6 class="p-b-4">
                                                <a href="blog-detail-02.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                    {{ Illuminate\Support\Str::limit($key->TenBV, $limit = 77, $end = '...') }}
                                                </a>
                                            </h6>

                                        </div>
                                    @endforeach
                                </li>
                            </ul>
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
    </section>
@endsection
