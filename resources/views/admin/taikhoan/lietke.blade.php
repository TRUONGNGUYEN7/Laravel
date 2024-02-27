@extends('admin')
@section('adcontent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-BkL6OD4jhRZR7e8n8h1taK1OcFv3odweNclC1Rg5PjRZQk+5FARISb3digFXxmPgzq4F5WtRY2qB5SnRI9C/oA=="
        crossorigin="anonymous" />

    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">

                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Quản lý</a></li>
                        <li class="breadcrumb-item" aria-current="page">Danh mục bài viết</li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="table-agile-info">
            <div style="" class="panel panel-default">
                <div class="row w3-res-tb">
                    <div class="col-sm-3">
                        <div class="container">
                            <div class="searchbar">
                                <div class="searchbar-wrapper">
                                    <div class="searchbar-left">
                                        <div class="search-icon-wrapper">
                                            <span class="search-icon searchbar-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                                                    </path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="searchbar-center">
                                        <div class="searchbar-input-spacer"></div>
                                        <input type="text" class="searchbar-input" maxlength="2048" id="myInput"
                                            autocapitalize="off" placeholder="Search Google">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

                <script>
                    $(document).ready(function() {
                        $(document).on('click', '.toggle-status-link', function(e) {
                            e.preventDefault();

                            var link = $(this);
                            var icon = link.find('i');
                            var id = link.data('id');

                            // Determine the current status based on the existing class
                            var currentStatus = link.hasClass('show-link') ? 1 : 0;

                            var url = `{{ route('admin.danhmuc.status', ['id' => ':id', 'value' => ':value']) }}`
                                .replace(':id', id)
                                .replace(':value', currentStatus);

                            $.ajax({
                                url: url,
                                type: 'GET',
                                success: function(data) {
                                    console.log('Status updated successfully:', data);

                                    // Toggle the classes and icon based on the server response
                                    link.toggleClass('show-link hide-link');
                                    icon.toggleClass('fas fa-eye fas fa-eye-slash');

                                    // Display an alert if the value is 1
                                    if (currentStatus === 1) {
                                        alert('Đã tắt trạng thái.');
                                    } else {
                                        alert('Đã bật trạng thái.');
                                    }

                                },
                                error: function(xhr, status, error) {
                                    console.log('Error updating status:', error);
                                },
                            });
                        });
                    });
                </script>

                <!-- Button to trigger modal -->
                <div style="margin-bottom: 10px" class="container mt-3">
                    <button type="button" class="btn btn-primary" id="openModalButton">
                        Thêm
                    </button>
                </div>


                <!-- Modal ADĐ -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <form id="addForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Thêm tài khoản</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Input fields and other content go here -->
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Tên đăng nhập</label>
                                        <input type="text" class="form-control" id="Name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Hoten" class="form-label">Họ tên</label>
                                        <input type="text" class="form-control" id="Hoten">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="Email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="MatKhau" class="form-label">MatKhau</label>
                                        <input type="text" class="form-control" id="MatKhau">
                                    </div>
                                    <label class="control-label">Vai trò</label>

                                    <select class="form-control" name="idvaitro" id="idvaitro">
                                        @foreach ($dsroles as $key => $item)
                                            @if ($item->id != 1)
                                                <option value="{{ $item->id }}"
                                                    {{ old('idvaitro') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endif
                                        @endforeach

                                    </select>
                                    @if ($errors->has('iddanhmuc'))
                                        <span class="help-block">{{ $errors->first('iddanhmuc') }}</span>
                                    @endif

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- ADD --}}
                    <script>
                        document.getElementById('addForm').addEventListener('click', function() {
                            // Lấy giá trị mới của các trường input
                            var newName = document.getElementById('Name').value;
                            var newHoten = document.getElementById('Hoten').value;
                            var newEmail = document.getElementById('Email').value;
                            var newPass = document.getElementById('MatKhau').value;
                            var selectedRoleId = document.getElementById('idvaitro').value;

                            // Gửi dữ liệu form đến route store
                            fetch('{{ route('admin.accounts.store') }}', {
                                    method: 'POST', // Sử dụng method POST thay vì PUT
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        Name: newName,
                                        Hoten: newHoten,
                                        Email: newEmail,
                                        MatKhau: newPass,
                                        roleID: selectedRoleId // Thêm ID vai trò vào dữ liệu gửi đi
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    // Xử lý kết quả trả về (nếu cần)
                                    console.log(data);

                                    // Đóng modal sau khi lưu thành công
                                    $('#editModal').modal('hide');
                                    renderRoleList();
                                    alert('Thêm tài khoản thành công')
                                })
                                .catch(error => console.error('Error:', error));
                        });
                    </script>
                </div>

                {{-- Script for handling Edit button click --}}
                <script>
                    $(document).ready(function() {
                        $('.btn-warning').click(function() {
                            var adminId = $(this).data('id');
                            $.ajax({
                                url: '{{ route('admin.accounts.getaccountByID', ':id') }}'.replace(':id',
                                    adminId),
                                method: 'GET',
                                success: function(response) {
                                    $('#Nameedit').val(response.Name);
                                    $('#Hotenedit').val(response.Hoten);
                                    $('#Emailedit').val(response.Email);
                                    $('#MatKhauedit').val(response.MatKhau);
                                    $('#idvaitroedit').val(response.roleID).change();
                                    // Set adminId to a hidden input for later use
                                    $('#adminId').val(adminId);
                                    $('#editModal').modal('show');
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        });
                    });
                </script>

                {{-- edit model --}}
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-dialog" role="document">

                            {{-- Hidden input to store adminId --}}
                            <input type="text" id="adminId" value="">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Thêm tài khoản</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Input fields and other content go here -->
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Tên đăng
                                            nhập</label>
                                        <input type="text" class="form-control" id="Nameedit">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Hoten" class="form-label">Họ tên</label>
                                        <input type="text" class="form-control" id="Hotenedit">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="Emailedit">
                                    </div>
                                    <div class="mb-3">
                                        <label for="MatKhau" class="form-label">MatKhau</label>
                                        <input type="text" class="form-control" id="MatKhauedit">
                                    </div>
                                    <label class="control-label">Vai trò</label>
                                    <select class="form-control" name="idvaitroedit" id="idvaitroedit">
                                        @foreach ($dsroles as $key => $item)
                                            @if ($item->id != 1)
                                                <option value="{{ $item->id }}"
                                                    {{ old('idvaitroedit') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('idvaitroedit'))
                                        <span class="help-block">{{ $errors->first('iddanhmuc') }}</span>
                                    @endif
                                    <div class="mb-3">
                                        <input type="checkbox" style="margin-left: 15px; margin-top: 11px" checked
                                            id="TrangThai" class="switch-btn" data-size="small" data-color="#0099ff">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="EditBtn">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- Script for handling form submission --}}
                    <script>
                        $(document).ready(function() {
                            // Event listener for Save button click
                            $('.btn-primary').click(function() {
                                // Get the admin ID from the button's data attribute
                                var adminId = $(this).data('id');

                                // Set the adminId to the hidden input
                                $('#adminId').val(adminId);
                            });

                            document.getElementById('EditBtn').addEventListener('click', function() {
                                // Get the adminId from the hidden input
                                var adminIdget = document.getElementById('adminId').value;

                                // Get new values from input fields
                                var newName = document.getElementById('Nameedit').value;
                                var newHoten = document.getElementById('Hotenedit').value;
                                var newEmail = document.getElementById('Emailedit').value;
                                var newMatKhau = document.getElementById('MatKhauedit').value;
                                var newRoleId = document.getElementById('idvaitroedit').value;

                                // Get TrangThai value from the checkbox
                                var TrangThaiAD = document.getElementById('TrangThai').checked ? 1 : 0;

                                // Send form data to update route via AJAX
                                fetch('{{ route('admin.accounts.update', ['id' => ':id']) }}'.replace(':id', 5), {
                                        method: 'PUT',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            Name: newName,
                                            Hoten: newHoten,
                                            Email: newEmail,
                                            MatKhau: newMatKhau,
                                            roleID: newRoleId,
                                            TrangThai: TrangThaiAD
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        // Handle the response data if needed
                                        console.log(data);
                                        // Kiểm tra nếu cần làm mới trang
                                        if (data.reload_page) {
                                            location.reload(); // Làm mới trang
                                        }
                                        // Close the modal after successful update
                                        $('#editModal').modal('hide');

                                    })
                                    .catch(error => console.error('Error:', error));
                            });
                        });
                    </script>
                </div>

                <!-- Bootstrap Bundle with Popper -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

                <!-- JavaScript to handle button click event and show modal -->
                <script>
                    $(document).ready(function() {
                        // Find the button element by its ID
                        var openModalButton = $("#openModalButton");

                        // Add click event listener to the button
                        openModalButton.click(function() {
                            // Show the modal
                            $('#myModal').modal('show');
                        });
                    });
                </script>

                <div class="table-responsive">
                    <div class="container">
                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr style="background-color: #354b9f; color: white;">
                                    <th style="width: 5%; color: white">Tên danh mục</th>
                                    <th style="width: 5%; color: white">Tên nhóm quyền</th>
                                    <th style="width: 5%; color: white">Email</th>
                                    <th style="width: 5%; color: white">Trạng thái</th>
                                    <th style="width: 5%; color: white">Thao tác</th>
                                </tr>
                            </thead>

                            <tbody id="myTable">
                                @foreach ($ds as $key => $item)
                                    <tr style="">
                                        <td style="width: 5%;">{{ $item->Hoten }}</td>
                                        <td style="width: 5%;">{{ $item->roleName }}</td>
                                        <td style="width: 5%;">{{ $item->Email }}</td>
                                        <td style="width: 5%;">
                                            <div style="width: 10px;">
                                                <a href="#" data-id="{{ $item->IDAD }}"
                                                    class="toggle-status-link {{ $item->TrangThaiDM == 0 ? 'hide-link' : 'show-link' }}">
                                                    <i class="{{ $item->TrangThai == 0 ? 'fas fa-eye-slash' : 'fas fa-eye' }}"
                                                        id="status-icon-{{ $item->IDAD }}"></i>
                                                </a>
                                            </div>
                                        </td>

                                        <td style="width: 5%;">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <a data-id="{{ $item->IDAD }}" data-toggle="modal"
                                                        data-target="#editModal" href="#"
                                                        class="btn btn-warning"><i class="dw dw-edit"></i> Edit</a>

                                                </div>
                                                <div class="col-md-6">
                                                    <form
                                                        action="{{ route('admin.accounts.xoa', ['id' => $item->IDAD]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-danger show-alert-delete-box"
                                                            data-toggle="tooltip" title='Delete'><i
                                                                class="dw dw-delete-3"></i>Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    {{-- <footer class="panel-footer">
               <div class="row">
                    <div class="col-sm-5 text-center">
                         <small class="text-muted inline m-t-sm m-b-sm">Showing
                              {{ $ds->firstItem() }}-{{ $ds->lastItem() }} of
                              {{ $ds->total() }} items | Page {{ $ds->currentPage() }} of
                              {{ $ds->lastPage() }}</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                         {{ $ds->links('pagination::bootstrap-4') }}
                    </div>
               </div>


               </footer> --}}
                </div>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

            <script type="text/javascript">
                $('.show-alert-delete-box').click(function(event) {
                    var form = $(this).closest("form");
                    var name = $(this).data("name");
                    event.preventDefault();
                    swal({
                        title: "Bạn chắc chắn muốn xóa?",
                        text: "Nếu như xóa, dữ liệu sẽ không thể khôi phục",
                        icon: "warning",
                        type: "warning",
                        buttons: ["Cancel", "Yes!"],
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        }
                    });
                });
            </script>
        @endsection
