@extends('admin')
@section('adcontent')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                        <li class="breadcrumb-item" aria-current="page">Danh mục con</li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="pb-20">
            <div class="table-agile-info">
                <div class="panel panel-default">
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
                    <link rel="stylesheet"
                        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

                                var url = `{{ route('admin.baiviet.status', ['id' => ':id']) }}`
                                    .replace(':id', id)

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
                                        } else{
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
                    <div class="table-responsive">
                        <div class="container">
                            <table class="table table-striped b-t b-light">
                                <thead>
                                    <tr style="background-color: #354b9f; color: white;">
                                        <th style="width: 20rem; color: white">Tên bài viết </th>
                                        <th style="width: 20rem; color: white">Mô tả</th>
                                        <th style="width: 15rem; color: white">Tên chủ đề</th>
                                        <th style="width: 10rem; color: white">Lượt xem</th>
                                        <th style="width: 5rem; color: white">NguoiDangBV</th>
                                        <th style="width: 5rem; color: white">Trạng thái</th>
                                        <th style="width: 10rem; color: white">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @foreach ($dslietke as $key => $item)
                                        <tr style="">
                                            <td style="width: 250px">{{ $item->TenBV }}</td>
                                            <td style="width: 380px">{{ $item->Mota }}</td>
                                            <td>{{ $item->TenChuDe }}</td>
                                            <td style="width: 10px;">{{ $item->LuotXem }}</td>
                                            <td style="width: 10px;">{{ $item->NguoiDangBV }}</td>
                                            <td>
                                                <div style="width: 30px;">
                                                    <a href="#" data-id="{{ $item->IDBV }}"
                                                        class="toggle-status-link {{ $item->TrangThaiBV == 0 ? 'hide-link' : 'show-link' }}">
                                                        <i class="{{ $item->TrangThaiBV == 0 ? 'fas fa-eye-slash' : 'fas fa-eye' }}"
                                                            id="status-icon-{{ $item->IDBV }}"></i>
                                                    </a>
                                                </div>

                                            </td>
                                            <td style="width: 120px;">
                                                <a href="{{ route('admin.baiviet.sua', ['id' => $item->IDBV]) }}"
                                                    class="btn btn-warning"><i class="dw dw-edit"></i> Edit</a>
                                                <form action="{{ route('admin.baiviet.xoa', ['id' => $item->IDBV]) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger show-alert-delete-box"
                                                        data-toggle="tooltip" title='Delete'><i
                                                            class="dw dw-delete-3"></i>Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        <footer class="panel-footer">
                            <div class="row">
                                <div class="col-sm-5 text-center">
                                    <small class="text-muted inline m-t-sm m-b-sm">Hiển thị
                                        {{ $dslietke->firstItem() }}-{{ $dslietke->lastItem() }} của
                                        {{ $dslietke->total() }} mục | Trang {{ $dslietke->currentPage() }} /
                                        {{ $dslietke->lastPage() }}</small>
                                </div>
                                <div class="col-sm-7 text-right text-center-xs">
                                    {{ $dslietke->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>

                <div class="pagination-block">

                </div>
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
