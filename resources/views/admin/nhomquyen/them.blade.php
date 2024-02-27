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
                <div style="margin-left: 0px" class="sidebar">
                    <h3 style="color: #007bff">Nhóm quyền</h3>
                    <!-- Form thêm roles -->
                    <form style="margin-top: 20px;" id="addRoleForm" action="{{ route('admin.nhomquyen.store') }}"
                        method="POST">
                        {{ csrf_field() }} <!-- CSRF protection token -->
                        <div class="input-group" style="width: 90%; display: flex;">
                            <input type="text" name="tennhomquyen" id="tennhomquyen" class="form-control" required>
                            <button type="submit" name="themnq" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>

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

                    <ul id="roleList" class="list-unstyled"></ul>

                    {{-- Hàm để đổ danh sách vai trò --}}
                    <script>
                        function renderRoleList() {
                            var roleListElement = document.getElementById('roleList');
                            // Xóa danh sách cũ trước khi cập nhật
                            roleListElement.innerHTML = '';

                            // Gửi yêu cầu Ajax để lấy danh sách vai trò từ server
                            fetch('{{ route('admin.nhomquyen.get') }}')
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
                                        selectButton.innerText = 'Chọn';
                                        selectButton.addEventListener('click', function() {
                                            // Lấy thông tin về vai trò được chọn từ nút "Chọn" được nhấn
                                            let roleId = selectButton.getAttribute('data-id');
                                            let roleName = selectButton.getAttribute('data-name');
                                            // Gán ID và tên của vai trò vào input và nhãn tương ứng
                                            document.getElementById('selectedRoleID').value = roleId;
                                            document.getElementById('selectedRoleLabel').innerText = 'Nhóm đã chọn:  ' +
                                                roleName;

                                            clearCheckboxStates();

                                            // Nếu không có ID vai trò, không làm gì cả
                                            if (!roleId) return;

                                            // Thực hiện AJAX request để lấy danh sách permission dựa trên vai trò
                                            var url =
                                                `{{ route('admin.permissionRole.getRoutesPermissionByID', ['id' => ':id']) }}`
                                                .replace(':id', roleId);
                                            $.ajax({
                                                url: url,
                                                type: 'GET',
                                                success: function(data) {
                                                    // Lặp qua danh sách permission và kiểm tra checkbox tương ứng
                                                    data.forEach(permission => {
                                                        var permissionId = permission
                                                            .permissionID; // Lấy ID của permission từ dữ liệu AJAX
                                                        var checkbox = document.getElementById(
                                                            permissionId);
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
                                        // Hàm để xóa trạng thái đã chọn của tất cả các checkbox
                                        function clearCheckboxStates() {
                                            var checkboxes = document.querySelectorAll('.form-check-input');
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
                                            document.getElementById('tennhomquyensua').value = roleName;
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
                            fetch('{{ route('admin.nhomquyen.store') }}', {
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
                                fetch('{{ route('admin.nhomquyen.xoa', ['id' => ':id']) }}'.replace(':id', roleId), {
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

                    <!-- Popup Sửa -->
                    <div style="margin-left: -20%; margin-top: 10em" class="modal" id="editModal" tabindex="-1"
                        role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Chỉnh sửa</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editForm" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <!-- Thêm input tennhomquyen -->
                                        <div class="form-group">
                                            <label for="tennhomquyen">Tên vai trò</label>
                                            <input type="text" value="" class="form-control" id="tennhomquyensua"
                                                name="tennhomquyensua">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <button type="button" class="btn btn-primary" id="EditBtn">Lưu</button>
                                    </div>
                                </form>
                                <script>
                                    document.getElementById('EditBtn').addEventListener('click', function() {
                                        // Lấy giá trị mới của input
                                        var newName = document.getElementById('tennhomquyensua').value;
                                        // Lấy ID của vai trò từ input ẩn
                                        var roleId = document.getElementById('selectedRoleID').value;
                                        // Gửi dữ liệu form đến route update
                                        fetch('{{ route('admin.nhomquyen.update', ['id' => ':id']) }}'.replace(':id', roleId), {
                                                method: 'PUT',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                },
                                                body: JSON.stringify({
                                                    tennhomquyensua: newName
                                                })
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                // Xử lý kết quả trả về (nếu cần)
                                                console.log(data);

                                                // Đóng modal sau khi lưu thành công
                                                $('#editModal').modal('hide');
                                                renderRoleList();
                                                alert('Cập nhật thành công')
                                            })
                                            .catch(error => console.error('Error:', error));
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

            <div class="col-md-9">
                <!-- Form và danh sách ngang -->
                <div style="margin-left: 2%; margin-bottom: 2%">
                    <h4 id="selectedRoleLabel">Chọn Quyền</h4>
                    <hr style="margin-top: 5px; margin-bottom: 5px;"> <!-- Thêm đường kẻ ngang -->
                </div>
                {{-- DSROUTE --}}
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

        {{-- show route --}}
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

                    // Kiểm tra xem đã chọn vai trò hay chưa
                    if (!selectedRoleID) {
                        alert('Vui lòng chọn một vai trò');
                        return; // Thoát khỏi sự kiện nếu không có vai trò được chọn
                    }

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
