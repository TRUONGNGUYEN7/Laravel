@extends('admin')
@section('adcontent')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tạo và quản lý chức năng</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <div class="col-md-12">
            <!-- Form thêm chức năng -->
            <form action="{{ route('admin.chucnang.store') }}" method="POST">
                {{ csrf_field() }} <!-- CSRF protection token -->

                <div class="input-group" style="width: 540px; display: flex;">
                    <!-- Submit button to add functionality -->
                    <button type="submit" name="themcn" class="btn btn-primary">Thêm Chức Năng</button>

                    <!-- Input field for entering functionality name -->
                    <input type="text" name="tencn" value="{{ old('tencn') }}" id="tencn" class="form-control"
                        required>
                </div>
            </form>

            <!-- Form và danh sách ngang -->
            <div class="content">
                <form class="form-horizontal" method="post" action="">
                    @csrf

                    <!-- Tabs -->
                    <ul class="nav nav-pills">
                        @foreach ($ds as $item)
                            <li class="nav-item">
                                <!-- Đặt data-id cho mỗi tab để có thể lấy giá trị khi click -->
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" aria-current="page" href="#"
                                    data-id="{{ $item->IDCN }}">
                                    {{ $item->TenCN }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Danh sách chức năng -->
                    <div class="list-group" id="chucnangList">
                        <!-- Danh sách chức năng sẽ được đổ động từ JavaScript -->

                    </div>

                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                var selectedTabId = ''; // Biến để lưu giữ idchucnang của tab được chọn
                var selectedTabRouteTitle = ''; // Biến để lưu giữ route_title của tab được chọn

                // Sự kiện khi click vào tab
                $('.nav-link').on('click', function(e) {
                    e.preventDefault();
                    selectedTabId = $(this).data('id'); // Lấy giá trị data-id của tab đã click
                    selectedTabRouteTitle = $(this).text(); // Lấy giá trị text của tab đã click

                    // Gán giá trị route_title của tab đã click vào input idchucnang
                    $('#idchucnang').val(selectedTabRouteTitle);

                    // Gửi yêu cầu AJAX để lấy danh sách chức năng từ route
                    fetch('{{ route('getChucNangByChucNangId', ['id' => ' ']) }}' + selectedTabId)
                        .then(response => response.json())
                        .then(data => {
                            // Xóa danh sách chức năng hiện tại
                            $('#chucnangList').empty();

                            // Đổ danh sách chức năng mới từ dữ liệu trả về
                            data.forEach(chucnang => {
                                var listItem = $(
                                    '<a href="#" class="list-group-item"></a>'); // Tạo thẻ <a> mới
                                listItem.text(chucnang.Route_title);

                                // Tạo thẻ <a> để làm nút xóa
                                var deleteLink = $(
                                    '<a href="#" class="toggle-status-link">Xóa</a>');
                                deleteLink.data('id', chucnang.ID); // Thêm thuộc tính data-id

                                listItem.append(
                                    deleteLink); // Thêm nút xóa vào mỗi mục danh sách chức năng

                                $('#chucnangList').append(
                                    listItem); // Thêm mục danh sách chức năng vào danh sách
                            });

                            // Thêm nút vào cuối mỗi tab
                            var tabButton = $('<a href="#" class="">Thêm</a>'); // Tạo nút mới
                            tabButton.click(checkAndShowPopup); // Gán sự kiện click cho nút mới
                            $('#chucnangList').append(tabButton); // Thêm nút vào danh sách chức năng

                        })
                        .catch(error => console.error('Lỗi khi lấy danh sách chức năng:', error));
                });

                // Sự kiện khi form được submit
                $('#login-form').on('submit', function(e) {
                    e.preventDefault();
                    // Perform AJAX request
                    $.ajax({
                        url: "{{ route('admin.routes.store') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: $(this).serialize() + "&idchucnang=" +
                            selectedTabId, // Truyền thêm idchucnang vào dữ liệu gửi đi
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
            });


            $(document).ready(function() {
                // Gắn sự kiện click vào các nút xóa
                $(document).on('click', '.toggle-status-link', function(e) {
                    e.preventDefault();

                    var link = $(this);
                    var idCN = link.data('id');

                    var url = ``
                        .replace(':id', idCN);
                    $.ajax({
                        url: url,
                        type: 'GET', // Sử dụng phương thức DELETE
                        success: function(data) {
                            alert('Xóa thành công');
                            // Loại bỏ phần tử đã xóa khỏi DOM
                            link.closest('.list-group-item').remove();
                        },
                        error: function(xhr, status, error) {
                            console.error('Lỗi khi xóa:', error);
                        },
                    });
                });
            });
        </script>

        {{-- show popup login --}}
        <script>
            function checkAndShowPopup() {
                document.getElementById('login-form-wrap').style.display = 'block';
            }
        </script>

        <div id="login-form-wrap">
            <div class="login-header">
                <h1 style="font-size: 20px">Thêm</h1>
                <button onclick="document.getElementById('login-form-wrap').style.display = 'none';"
                    class="close-button">&times;</button>
            </div>

            <form id="login-form">
                {{ csrf_field() }}

                <div class="form-group row">
                    <label for="idchucnang" class="col-sm-3 control-label">Chức năng:</label>
                    <div class="col-sm-8">
                        <input type="text" id="idchucnang" name="idchucnang" placeholder="idchucnang" required
                            class="form-control">
                        <i class="validation"></i>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="routesource" class="col-sm-3 control-label">Routesource:</label>
                    <div class="col-sm-8">
                        <input type="text" id="routesource" name="routesource" placeholder="routesource" required
                            class="form-control">
                        <i class="validation"></i>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="routetitle" class="col-sm-3 control-label">Routetitle:</label>
                    <div class="col-sm-8">
                        <input type="text" id="routetitle" name="routetitle" placeholder="routetitle" required
                            class="form-control">
                        <i class="validation"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" id="login" value="Login" class="btn btn-primary">
                    </div>
                </div>
            </form>



        </div>
        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- SweetAlert CDN (SweetAlert2) -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style>
            #login-form-wrap {
                display: none;
                position: fixed;
                top: 65%;
                left: 40%;
                width: 72%;
                max-width: 700px;
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
                margin-left: 20%;
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

            .validation {
                display: none;
                position: absolute;
                content: " ";
                height: 60px;
                width: 30px;
                right: 15px;
                top: 0px;
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
        <style>
            .content {
                background-color: #ffffff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h2 {
                color: #007bff;
            }

            p {
                color: #555;
            }

            .nav-link {
                color: #007bff;
            }

            .nav-link:hover {
                text-decoration: underline;
            }
        </style>
        <style>
            .sidebar {
                background-color: #f8f9fa;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .content {
                padding: 20px;
            }

            .nav-link {
                color: #007bff;
            }

            .nav-link:hover {
                text-decoration: underline;
            }
        </style>
    </body>

    </html>

    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }

        #subFunctionButtons {
            margin-top: 20px;
        }

        .button {
            padding: 10px 20px;
            margin: 0 10px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
@endsection
