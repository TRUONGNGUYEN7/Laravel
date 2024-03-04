@extends('admin')
@section('adcontent')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
                <div style="margin-left: 0px" class="sidebar">
                    <h3 style="color: #007bff">Nhóm quyền</h3>
                    <!-- Form thêm roles -->

                    <style>
                        #roleList {
                            list-style: none;
                            padding: 0;
                        }

                        .role-item {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            padding: 10px;
                            border-bottom: 1px solid #ccc;
                        }

                        .role-name {
                            flex: 1;
                            margin-right: 10px;
                        }

                        .action-buttons {
                            flex-shrink: 0;
                            display: flex;
                            gap: 5px;
                        }

                        /* Sử dụng media query để điều chỉnh kích thước danh sách vai trò */
                        @media (max-width: 768px) {
                            .role-item {
                                flex-direction: column;
                                /* Hiển thị dạng dọc khi màn hình có kích thước nhỏ hơn 768px */
                            }

                            .role-name {
                                margin-bottom: 10px;
                                /* Khoảng cách dưới tên vai trò */
                            }

                            .action-buttons {
                                margin-top: 10px;
                                /* Khoảng cách trên các nút hành động */
                            }
                        }
                    </style>

                    <div id="addRoleForm"></div>
                    <ul id="roleList" class="list-unstyled"></ul>

                    {{-- Hàm để đổ danh sách vai trò --}}
                    <script>
                        function renderRoleList() {
                            var roleListElement = document.getElementById('roleList');
                            // Xóa danh sách cũ trước khi cập nhật
                            roleListElement.innerHTML = '';

                            // Gửi yêu cầu Ajax để lấy danh sách vai trò từ server
                            fetch('{{ route('admin.vaitro.get') }}')
                                .then(response => response.json())
                                .then(data => {
                                    // Duyệt qua từng vai trò và thêm vào danh sách
                                    data.forEach(role => {
                                        var listItem = document.createElement('li');
                                        listItem.classList.add('role-item');

                                        var nameColumn = document.createElement('div');
                                        nameColumn.classList.add('role-name');
                                        nameColumn.innerText = role.name;

                                        var actionButtons = document.createElement('div');
                                        actionButtons.classList.add('action-buttons');

                                        var deleteButton = document.createElement('button');
                                        deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'delete-button',
                                            'show-alert-delete-box');
                                        deleteButton.setAttribute('data-id', role.id);
                                        deleteButton.innerText = 'Xóa';
                                        deleteButton.addEventListener('click', function() {
                                            var roleId = deleteButton.getAttribute('data-id');
                                            deleteRole(roleId);
                                        });

                                        var editButton = document.createElement('button');
                                        editButton.classList.add('btn', 'btn-primary', 'btn-sm', 'edit-button');
                                        editButton.setAttribute('data-id', role.id);
                                        editButton.setAttribute('data-name', role.name);
                                        editButton.innerText = 'Sửa';

                                        var selectButton = document.createElement('button');
                                        selectButton.classList.add('btn', 'btn-success', 'btn-sm', 'select-button');
                                        selectButton.setAttribute('data-id', role.id);
                                        selectButton.setAttribute('data-name', role.name);
                                        selectButton.setAttribute('data-status', role.status); // Thêm thuộc tính trạng thái
                                        selectButton.innerText = 'Chọn';

                                        selectButton.addEventListener('click', function() {
                                            clearCheckboxStates();
                                            $("#submitButton").text("Sửa");
                                            // Lấy thông tin về vai trò được chọn từ nút "Chọn" được nhấn
                                            let roleId = selectButton.getAttribute('data-id');
                                            let roleName = selectButton.getAttribute('data-name');
                                            let roleStatus = selectButton.getAttribute(
                                                'data-status'); // Lấy giá trị trạng thái
                                            // Gán ID và tên của vai trò vào input và nhãn tương ứng
                                            document.getElementById('selectedRoleID').value = roleId;
                                            document.getElementById('tennhomquyen').value = roleName;

                                            // Gán giá trị trạng thái vào select
                                            document.getElementById('trangthai').value = roleStatus;

                                            // Nếu không có ID vai trò, không làm gì cả
                                            if (!roleId) return;

                                            // Thực hiện AJAX request để lấy danh sách permission dựa trên vai trò
                                            var url =
                                                `{{ route('admin.permissionRole.getRoutesPermissionByID', ['id' => ':id']) }}`
                                                .replace(':id', roleId);
                                            $.ajax({
                                                url: url,
                                                type: 'GET',
                                                // Sau khi nhận được dữ liệu AJAX
                                                success: function(data) {
                                                    // Lặp qua danh sách permission và kiểm tra checkbox tương ứng
                                                    data.forEach(permission => {
                                                        var permissionId = permission
                                                            .permissionID; // Lấy ID của permission từ dữ liệu AJAX
                                                        var checkbox = document.getElementById(
                                                            'permission_' + permissionId);
                                                        if (checkbox) {
                                                            checkbox.checked = true;
                                                        }
                                                    });
                                                },
                                                error: function(xhr, status, error) {
                                                    console.log('Error:', error);
                                                }
                                            });
                                        });


                                        function clearCheckboxStates() {
                                            // Lấy tất cả các checkbox
                                            var checkboxes = document.querySelectorAll('input[type="checkbox"]');

                                            // Duyệt qua mỗi checkbox và đặt trạng thái unchecked
                                            checkboxes.forEach(function(checkbox) {
                                                checkbox.checked = false;
                                            });
                                        }

                                        actionButtons.appendChild(selectButton);
                                        actionButtons.appendChild(editButton);
                                        actionButtons.appendChild(deleteButton);

                                        listItem.appendChild(nameColumn);
                                        listItem.appendChild(actionButtons);
                                        roleListElement.appendChild(listItem);

                                        // Thêm sự kiện click cho nút "Sửa" sau khi nút được thêm vào DOM
                                        editButton.addEventListener('click', function() {
                                            let roleName = editButton.getAttribute('data-name');
                                            // Gán tên vai trò vào input trong form sửa
                                            document.getElementById('tenvaitro').value = roleName;
                                            // Hiển thị modal sửa
                                            let roleId = selectButton.getAttribute('data-id');
                                            document.getElementById('selectedRoleID').value = roleId;
                                            $('#editModal').modal('show');
                                        });
                                    });
                                    console.log(data);
                                })
                                .catch(error => console.error('Error:', error));
                        }

                        // Bắt sự kiện submit của form add vai trò
                        document.getElementById("addRoleForm").addEventListener("submit", function(event) {
                            event.preventDefault(); // Chặn sự kiện mặc định của form

                            // Lấy dữ liệu từ form
                            var formData = new FormData(this);

                            // Gửi yêu cầu AJAX
                            fetch('{{ route('admin.vaitro.store') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: formData
                                })
                                .then(response => {
                                    if (response.ok) {
                                        return response.json();
                                    }
                                    throw new Error('Network response was not ok.');
                                })
                                .then(data => {
                                    if (data.success) {
                                        renderRoleList();
                                        document.getElementById('tennhomquyen').value = '';
                                        alert('Thêm nhóm quyền thành công!');
                                    } else {
                                        alert('Thêm nhóm quyền thất bại: ' + data.message);
                                    }
                                })
                                .catch(error => console.error('Error:', error));


                        });

                        function deleteRole(roleId) {
                            // Hiển thị hộp thoại xác nhận trước khi xóa
                            var confirmDelete = confirm("Bạn chắc chắn muốn xóa vai trò này?");
                            if (confirmDelete) {
                                // Nếu người dùng xác nhận muốn xóa
                                fetch('{{ route('admin.vaitro.xoa', ['id' => ':id']) }}'.replace(':id', roleId), {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            _method: 'POST'
                                        })
                                    })
                                    .then(response => {
                                        if (response.ok) {
                                            // Xóa mục khỏi danh sách và cập nhật giao diện
                                            var listItem = document.querySelector('.delete-button[data-id="' + roleId + '"]').closest(
                                                '.role-item');
                                            listItem.remove();
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                            }

                        }
                        // Gọi hàm để đổ danh sách vai trò khi trang được tải
                        renderRoleList();
                    </script>
                    <input type="hidden" id="selectedRoleID" name="selectedRoleID">
                    <!-- Popup Sửa -->
                    <div style="margin-left: -20%; margin-top: 10em" class="modal" id="editModal" tabindex="-1"
                        role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Chỉnh sửa</h4>
                                </div>
                                <form id="editForm" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <!-- Thêm input tennhomquyen -->
                                        <div class="form-group">
                                            <label for="tenvaitro">Tên vai trò</label>
                                            <input type="text" value="" class="form-control" id="tenvaitro"
                                                name="tenvaitro">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" id="closeModal">Đóng</button>
                                        <button type="button" class="btn btn-primary" id="EditBtn">Lưu</button>
                                    </div>
                                </form>

                                <script>
                                    // Đóng modal khi nhấn vào nút có id là 'closeModal'
                                    document.getElementById('closeModal').addEventListener('click', function() {
                                        $('#editModal').modal('hide');
                                    });
                                </script>

                                {{-- Edit vai trò --}}
                                <script>
                                    document.getElementById('EditBtn').addEventListener('click', function() {
                                        // Lấy giá trị mới của input
                                        var newName = document.getElementById('tenvaitro').value;
                                        // Lấy ID của vai trò từ input ẩn
                                        var roleId = document.getElementById('selectedRoleID').value;
                                        // Gửi dữ liệu form đến route update
                                        var url = '{{ route('admin.vaitro.update', ['id' => ':id']) }}'.replace(':id', roleId);

                                        // Dữ liệu JSON chứa tên mới của vai trò
                                        var jsonData = JSON.stringify({
                                            tenvaitro: newName
                                        });

                                        $.ajax({
                                            url: url,
                                            type: 'PUT', // Sử dụng phương thức PUT
                                            dataType: 'json',
                                            data: jsonData,
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            contentType: 'application/json',
                                            success: function(response) {
                                                // Đóng modal sau khi lưu thành công
                                                $('#editModal').modal('hide');
                                                renderRoleList();
                                                alert(response.message);
                                            },
                                            error: function(xhr, status, error) {
                                                // Lấy thông báo lỗi từ phản hồi JSON
                                                var errors = xhr.responseJSON.errors;

                                                // Hiển thị thông báo lỗi
                                                var errorMessage = "";
                                                $.each(errors, function(key, value) {
                                                    errorMessage += value + "\n";
                                                });
                                                alert(errorMessage);
                                                console.log('Error:', error);
                                            }
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .col-md-9 {
                    padding-left: 2%;
                }

                .groupper {
                    margin-bottom: 2%;
                }

                /* Sử dụng media query để điều chỉnh kích thước của div khi màn hình có kích thước nhỏ hơn hoặc bằng 768px */
                @media (max-width: 768px) {
                    .col-md-9 {
                        padding-left: 0;
                        /* Loại bỏ padding khi màn hình nhỏ hơn hoặc bằng 768px */
                    }

                    .groupper {
                        margin-left: 0;
                        /* Loại bỏ margin-left khi màn hình nhỏ hơn hoặc bằng 768px */
                        padding-left: 0;
                        /* Loại bỏ padding-left khi màn hình nhỏ hơn hoặc bằng 768px */
                    }

                    .form-group {
                        margin-left: 5%;
                        /* Điều chỉnh margin-left cho phần tử .form-group khi màn hình nhỏ hơn hoặc bằng 768px */
                        margin-right: 5%;
                        /* Điều chỉnh margin-right cho phần tử .form-group khi màn hình nhỏ hơn hoặc bằng 768px */
                    }

                    .col-lg-offset-5 {
                        margin-left: 5%;
                        /* Điều chỉnh margin-left cho phần tử .col-lg-offset-5 khi màn hình nhỏ hơn hoặc bằng 768px */
                    }

                    .col-lg-6 {
                        width: 90%;
                        /* Thiết lập chiều rộng của phần tử .col-lg-6 khi màn hình nhỏ hơn hoặc bằng 768px */
                    }
                }
            </style>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <div style="width: 60%;" class="col-md-9">
                <style>
                    .selector-for-some-widget {
                        box-sizing: content-box;
                    }

                    .scrollspy-example {
                        position: relative;
                        overflow-y: scroll;
                        height: 200px;
                        scroll-behavior: smooth;
                    }

                    body {
                        background-color: #e1dddd
                    }
                </style>
                <div class="bd-example">
                    <style>
                        .group-permission-name {
                            color: blue;
                        }
                    </style>

                    <form style="margin-top: 10px; " id="addPermissonRoleForm" action="{{ route('admin.vaitro.store') }}"
                        method="POST">
                        @csrf
                        <div class="input-group"
                            style="display: flex; align-items: center; margin-right: 10px; width: 600px;">
                            <label for="tennhomquyen" style="margin-right: 10px;">Tên nhóm quyền:</label>
                            <input type="text" name="tennhomquyen" id="tennhomquyen" placeholder="Nhập tên nhóm quyền"
                                class="form-control" required style="flex: 1;">
                            @if ($errors->has('tennhomquyen'))
                                <span class="help-block">{{ $errors->first('tennhomquyen') }}</span>
                            @endif

                            <select name="trangthai" id="trangthai" class="form-select" style="margin-left: 10px;" required>
                                <option value="">Chọn trạng thái</option>
                                <option value="1">Kích hoạt</option>
                                <option value="0">Không kích hoạt</option>
                            </select>

                            <!-- Sử dụng icon của Font Awesome -->
                            <button type="button" id="refreshButton" class="btn btn-secondary"
                                style="margin-left: 10px; border-radius: 10px; font-size: 0.7rem ; color: #ffffff;">
                                <i class="fas fa-sync-alt"></i> <!-- Biểu tượng "làm mới" -->
                            </button>
                        </div>

                        {{-- làm mới --}}
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            // Định nghĩa hàm để làm mới trường tên nhóm quyền và chọn trạng thái
                            function refreshFields() {
                                // Làm mới trường tên nhóm quyền
                                $('#tennhomquyen').val('');
                                // Làm mới trạng thái
                                $('#selectedRoleID').val('');
                                $('#trangthai').val('');
                                $("#submitButton").text("Thêm");
                                // Làm mới các checkbox
                                $('input[type="checkbox"]').prop('checked', false);
                            }
                            // Gọi hàm refreshFields khi nút "Làm mới" được click
                            $(document).ready(function() {
                                $('#refreshButton').click(function() {
                                    refreshFields();
                                });
                            });
                        </script>

                        <div class="row border">
                            <div class="col-4 border-end">
                                <!-- Add border-end class to apply border to the right -->
                                <div style=" margin-top: 1rem; " id="list-example" class="list-group">
                                    @foreach ($dsgrouppermission as $key => $item)
                                        <a class="list-group-item list-group-item-action{{ $key === 0 ? ' active' : '' }}"
                                            href="#list-item-{{ $key + 1 }}">
                                            <h6>{{ $item->displayName }}</h6>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-8">
                                <div style=" margin-top: 1rem; margin-left: 2rem" data-bs-spy="scroll"
                                    data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example"
                                    tabindex="1">
                                    @foreach ($dsgrouppermission as $key => $item)
                                        <h4 id="list-item-{{ $key + 1 }}" class="group-permission-name">
                                            {{ $item->displayName }}</h4>
                                        @foreach ($item->permissions as $permission)
                                            <div style="margin-bottom: 16px;">
                                                <input type="checkbox" id="permission_{{ $permission->id }}"
                                                    name="permissions[]" value="{{ $permission->id }}">
                                                <label for="permission_{{ $permission->id }}"
                                                    style="margin-left: 5px;">{{ $permission->displayName }}</label>
                                            </div>
                                        @endforeach
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 2rem; margin-left: 20rem">
                            <button type="submit" id="submitButton" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>

                </div>

                {{-- add or update --}}
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        // Gắn sự kiện submit cho formdataroute
                        $('#addPermissonRoleForm').submit(function(event) {
                            event.preventDefault(); // Ngăn chặn form submit mặc định

                            // Lấy tên nhóm quyền từ input
                            var tennhomquyen = $('#tennhomquyen').val();

                            // Lấy trạng thái từ select
                            var Status = $('#trangthai').val();

                            // Khởi tạo mảng selectedActions để lưu trữ ID của các checkbox được chọn
                            var selectedActions = [];

                            // Lặp qua tất cả các checkbox được chọn
                            $('input[name="permissions[]"]:checked').each(function() {
                                // Lấy ID của action từ thuộc tính value của checkbox
                                var actionId = $(this).val();

                                // Thêm ID vào mảng selectedActions
                                selectedActions.push(actionId);
                            });

                            // Chuyển đổi thành một đối tượng JSON
                            var jsonData = JSON.stringify({
                                "tennhomquyen": tennhomquyen,
                                "Status": Status,
                                "selectedActions": selectedActions,
                                "_token": '{{ csrf_token() }}' // Thêm token CSRF vào dữ liệu gửi đi
                            });

                            // Kiểm tra xem selectedRoleID có giá trị hay không
                            var selectedRoleID = $('#selectedRoleID').val();

                            // Tạo URL từ route Laravel
                            var url = '';
                            if (selectedRoleID) {
                                // Nếu selectedRoleID có giá trị, gọi route updatePermissionRole
                                url =
                                    '{{ route('admin.permissionRole.updatePermissionRole', ['id' => ':id']) }}'
                                    .replace(':id', selectedRoleID);
                            } else {
                                // Nếu selectedRoleID trống, gọi route addPermissionRole
                                url = '{{ route('admin.permissionRole.addPermissionRole') }}';
                            }

                            // Gửi dữ liệu JSON đến route xử lý trên máy chủ
                            $.ajax({
                                url: url,
                                type: 'POST',
                                dataType: 'json',
                                data: jsonData,
                                contentType: 'application/json',
                                success: function(response) {
                                    renderRoleList();
                                    $('#tennhomquyen').val('');
                                    $('#trangthai').val('');
                                    alert(response.message);

                                },
                                error: function(xhr, status, error) {
                                    // Lấy thông báo lỗi từ phản hồi JSON
                                    var errors = xhr.responseJSON.errors;

                                    // Hiển thị thông báo lỗi
                                    var errorMessage = "";
                                    $.each(errors, function(key, value) {
                                        errorMessage += value + "\n";
                                    });
                                    alert(errorMessage);
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

            </div>
            <style>
                .border {
                    border: 1px solid #ccc;
                    /* Adjust the color and style as needed */
                }
            </style>
        </div>
        <style>
            .groupper h4 {
                text-align: center;
                color: #007bff;
                margin-bottom: 10px;
            }
        </style>

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
