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
    <section class="p-b-140 p-t-10">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 p-b-30">
                    <div class="p-r-10 p-r-0-sr991">
                        <!-- Blog Detail -->
                        @if ($ttbaiviet)
                            <div class="p-b-70">

                                <h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
                                    {{ $ttbaiviet->name }}
                                </h3>

                                <div class="flex-wr-s-s p-b-40">
                                    <span class="f1-s-3 cl8 m-r-15">
                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                            {{ $ttbaiviet->admin->name }}
                                        </a>
                                        <span class="m-rl-3">-</span>
                                    </span>

                                    <span class="f1-s-3 cl8 m-r-15">
                                        {{ $ttbaiviet->views }} Views
                                    </span>

                                    <a href="#" class="f1-s-3 cl8 hov-cl10 trans-03 m-r-15">
                                        0 Comment
                                    </a>
                                </div>

                                <p class="f1-s-11 cl6 p-b-25">
                                    {{ $ttbaiviet->describe }}
                                </p>
                                <div class="noidung">
                                    <?php
                                    $content = $ttbaiviet->content;
                                    
                                    // Tìm tất cả các đường dẫn hình ảnh trong nội dung
                                    if (preg_match_all('/<img[^>]+src="([^">]+)"/i', $content, $matches)) {
                                        $imageUrls = $matches[1];
                                    
                                        // Thay thế mỗi đường dẫn hình ảnh bằng đường dẫn từ route displayImages
                                        foreach ($imageUrls as $imageUrl) {
                                            $newImageUrl = route('displayImages', ['fileName' => basename($imageUrl)]);
                                            $content = str_replace($imageUrl, $newImageUrl, $content);
                                        }
                                    }
                                    
                                    // Áp dụng các kiểu dáng cho mỗi hình ảnh, video, hoặc iframe
                                    if (preg_match_all('/<(img|iframe|video)[^>]+>/i', $content, $matches)) {
                                        $mediaElements = $matches[0];
                                    
                                        // Áp dụng kiểu dáng cho mỗi phần tử media
                                        foreach ($mediaElements as $mediaElement) {
                                            if (strpos($mediaElement, '<video') !== false) {
                                                // Nếu là video, thêm thuộc tính autoplay
                                                $styledMediaElement = str_replace('<video', '<video autoplay style="max-width:100%; height:auto; border: 1px solid #061041"', $mediaElement);
                                            } else {
                                                // Đối với hình ảnh và iframe, áp dụng kiểu dáng
                                                $styledMediaElement = str_replace('<' . $matches[1][0], '<' . $matches[1][0] . ' style="max-width:670px; height:auto;"', $mediaElement);
                                            }
                                            $content = str_replace($mediaElement, $styledMediaElement, $content);
                                        }
                                    }
                                    
                                    // Áp dụng kiểu dáng cho các đoạn văn bản
                                    $content = str_replace('<p>', '<p style="margin-bottom: 15px; margin-left: 1px">', nl2br($content));
                                    
                                    // Hiển thị nội dung đã được xử lý
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

                            <form id="form-comment" data-action="{{ route('comment/add') }}" method="POST">
                                {{ csrf_field() }}
                                <textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" name="noidung" id="noidung"
                                    placeholder="Comment..."></textarea>

                                <input type="submit" id="button-comment" value="Đăng">
                            </form>

                            {{-- //binhluan --}}
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
                                                    "{{ route('comment/add', ['id' => ':user_id']) }}";
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
                                                    "{{ route('comment/add', ['id' => ':user_id']) }}";
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

                        </div>

                        @include("$moduleName.elements.login")

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
                                    @foreach ($Post as $key)
                                        <a href="#" class="size-w-10 wrap-pic-w hov1 trans-03">
                                            <img style="margin-bottom: 10px"
                                                src='{{ asset($fileUploadPath . $key->image) }}' alt="IMG">
                                        </a>

                                        <div class="size-w-11">
                                            <h6 class="p-b-4">
                                                <a href="blog-detail-02.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                    {{ Illuminate\Support\Str::limit($key->name, $limit = 77, $end = '...') }}
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
                                    <a href="{{ route('user/view', ['id' => $key->id]) }}"
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
    </section>
@endsection
