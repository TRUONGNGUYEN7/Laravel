@extends('admin')
@section('adcontent')
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">

                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Quản lý</a></li>
                        <li class="breadcrumb-item" aria-current="page">Nhóm quyền</li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Your code to fade out the alert after 1 second
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 1000); // hide the alerts after 1 second

            // Display an alert message
            var message = "<?php echo Session::get('message'); ?>";
            if (message) {
                alert(message);
            }
        });
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!-- Danh sách dọc -->
                <div style="margin-left: -40px" class="sidebar">
                    <h3 style="color: #007bff">Nhóm quyền</h3>
                    <!-- Form thêm roles -->
                    <form style="margin-top: 20px;" action="{{ route('admin.nhomquyen.store') }}" method="POST">
                        {{ csrf_field() }} <!-- CSRF protection token -->
                        <div class="input-group" style="width: 90%; display: flex;">
                            <input type="text" name="tennhomquyen" value="{{ old('tencn') }}" id="tennhomquyen"
                                class="form-control" required>
                            <button type="submit" name="themnq" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                    <ul class="nav flex-column">
                        @foreach ($dsvaitro as $rl)
                            <li class="nav-item">
                                <a class="nav-link-vt active" data-vaitro="{{ $rl->id }}" aria-current="page"
                                    href="#">{{ $rl->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                <!-- Form và danh sách ngang -->
                <div style="margin-left: 2%; margin-bottom: 2%">
                    <h4 id="selectedRoleLabel">Chọn Quyền</h4>
                    <hr style="margin-top: 5px; margin-bottom: 5px;"> <!-- Thêm đường kẻ ngang -->
                </div>
                <div class="groupper" style="padding-left: 2%">

                </div>
                <form id="formdataroute" class="form-horizontal" method="post" action="#">
                    {{ csrf_field() }}
                    <!-- Button -->
                    <div class="form-group">
                        <div class="col-lg-offset-5 col-lg-6">
                            <button type="submit" name="themdataroute" class="btn btn-primary">Lưu </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <style>
            .groupper h4 {
                text-align: center;
                color: #007bff;
                margin-bottom: 10px;
            }
        </style>

        {{-- tab --}}
        <script>
            var checkedStates = {};

            // Lắng nghe sự kiện DOMContentLoaded để chạy mã sau khi trang đã được load
            document.addEventListener('DOMContentLoaded', function() {
                // Tạo một mảng chứa danh sách nhóm quyền
                var groupPermissions = [];

                // Duyệt qua từng nhóm quyền và thêm vào mảng groupPermissions
                @foreach ($dsgrouppermission as $item)
                    var group = {
                        id: '{{ $item->id }}',
                        displayName: '{{ $item->displayName }}',
                        actions: []
                    };

                    // Lấy danh sách action của nhóm quyền hiện tại
                    var url = `{{ route('admin.permissions.getRoutes', ['id' => ':id']) }}`.replace(':id', group.id);
                    $.ajax({
                        url: url,
                        type: 'GET',
                        async: false, // Đảm bảo thực hiện đồng bộ để đảm bảo danh sách nhóm quyền được xử lý theo thứ tự
                        success: function(data) {
                            group.actions = data;
                        },
                        error: function(xhr, status, error) {
                            console.log('Error:', error);
                        }
                    });

                    groupPermissions.push(group);
                @endforeach

                // Chia danh sách nhóm quyền thành 3 phần
                var groupsPerColumn = Math.ceil(groupPermissions.length / 3);

                // Tạo ba cột
                var columns = [];
                for (var i = 0; i < 3; i++) {
                    var column = document.createElement('div');
                    column.className = 'col-md-4';
                    columns.push(column);
                    document.querySelector('.groupper').appendChild(column);
                }

                // Hiển thị danh sách nhóm quyền và các action của từng nhóm trong từng cột
                groupPermissions.forEach(function(group, index) {
                    var columnIndex = Math.floor(index / groupsPerColumn); // Xác định cột thứ mấy

                    // Tạo tiêu đề cho nhóm quyền
                    var title = document.createElement('h4');
                    title.textContent = group.displayName;
                    title.className = 'text-center'; // Thêm lớp CSS để căn giữa tiêu đề

                    // Tạo danh sách ul cho các action của nhóm quyền
                    var ul = document.createElement('ul');
                    ul.className = 'list-group';

                    // Đổ danh sách action vào ul
                    group.actions.forEach(action => {
                        const listItem = document.createElement('li');
                        listItem.className = 'list-group-item';
                        listItem.innerHTML =
                            `<input class="form-check-input me-1" type="checkbox" id="${action.id}" value="${action.name}" aria-label="..."> ${action.displayName}`;
                        ul.appendChild(listItem);

                        // Khôi phục trạng thái checked của checkbox
                        if (checkedStates[action.id]) {
                            listItem.querySelector('input[type="checkbox"]').checked = true;
                        }
                    });

                    // Thêm tiêu đề và danh sách action vào cột tương ứng
                    columns[columnIndex].appendChild(title);
                    columns[columnIndex].appendChild(ul);
                });
            });
        </script>

        <style>
            .col-md-9 {
                background-color: #ffffff;
                /* Màu nền trắng */
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                /* Hiệu ứng shadow */
                padding: 20px;
                /* Khoảng cách padding */
                border-radius: 8px;
                /* Bo tròn viền */
            }
        </style>
        {{-- add permissionrole --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Gắn sự kiện submit cho formdataroute
                $('#formdataroute').submit(function(event) {
                    event.preventDefault(); // Ngăn chặn form submit mặc định

                    // Lấy ID của vai trò được chọn
                    var selectedRoleID = $('#selectedRoleID').val();

                    // Khởi tạo mảng selectedActions để lưu trữ ID của các checkbox được chọn
                    var selectedActions = [];

                    // Lặp qua tất cả các checkbox được chọn
                    $('.form-check-input:checked').each(function() {
                        // Lấy ID của action từ thuộc tính id của checkbox
                        var actionId = $(this).attr('id');

                        // Thêm ID vào mảng selectedActions
                        selectedActions.push(actionId);
                    });


                    // Chuyển đổi thành một đối tượng JSON
                    var jsonData = JSON.stringify({
                        "selectedActions": selectedActions,
                        "_token": '{{ csrf_token() }}' // Thêm token CSRF vào dữ liệu gửi đi
                    });

                    // Tạo URL từ route Laravel và thay thế ID của vai trò được chọn
                    var url = '{{ route('admin.permissionRole.updatePermissionRole', ':id') }}';
                    url = url.replace(':id', selectedRoleID);

                    // Gửi dữ liệu JSON đến route xử lý trên máy chủ với ID
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        data: jsonData,
                        contentType: 'application/json',
                        success: function(response) {

                            alert('Cập nhật thành công!');
                        },
                        error: function(xhr, status, error) {
                            console.log('Error:', error);
                        }
                    });
                });
            });


            // Lưu trạng thái của checkbox khi thay đổi
            $(document).on('change', '.form-check-input', function() {
                var id = $(this).attr('id');
                checkedStates[id] = this.checked;
            });
        </script>

        {{-- hienthivaitrolabel --}}
        <script>
            document.querySelectorAll('.nav-link-vt').forEach(item => {
                item.addEventListener('click', event => {
                    event.preventDefault();
                    // Hiển thị vai trò được chọn
                    document.getElementById('selectedRoleLabel').innerText = 'Nhóm đã chọn:  ' + item.innerText;
                });
            });
        </script>

        <input type="hidden" id="selectedRoleID" name="selectedRoleID">
        <script>
            $(document).ready(function() {
                $('.nav-link-vt').click(function() {
                    var selectedRoleID = $(this).data('vaitro');
                    $('#selectedRoleID').val(selectedRoleID);
                    console.log(selectedRoleID); // Kiểm tra xem đã lấy được ID của vai trò chưa
                });

                $('#formdataroute').submit(function(event) {
                    event.preventDefault(); // Ngăn chặn form submit mặc định

                    // Lấy ID của vai trò từ trường ẩn
                    var selectedRoleID = $('#selectedRoleID').val();
                    console.log(selectedRoleID); // Kiểm tra xem đã lấy được ID của vai trò từ trường ẩn chưa

                    // Tiếp tục với xử lý submit của form
                });
            });
        </script>

        <style>
            #selectedRoleLabel {
                color: red;
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
    @endsection
