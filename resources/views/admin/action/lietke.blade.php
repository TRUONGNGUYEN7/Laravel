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
                        <li class="breadcrumb-item" aria-current="page">Danh mục routes</li>
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

                <div class="panel-body">
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

                    <form action="{{ route('admin.routes.store') }}" method="POST" class="form-horizontal ">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group {{ $errors->has('routetitle') ? 'has-error' : 'has-success' }}">
                                    <label class="col-lg-4 control-label">Tên pages</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="routetitle" value="{{ old('routetitle') }}"
                                            id="routetitle" class="form-control">
                                        @if ($errors->has('routetitle'))
                                            <span class="help-block">{{ $errors->first('routetitle') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group {{ $errors->has('routesource') ? 'has-error' : 'has-success' }}">
                                    <label class="col-lg-4 control-label">Đường dẫn</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="routesource" value="{{ old('routesource') }}"
                                            id="routesource" class="form-control">
                                        @if ($errors->has('routesource'))
                                            <span class="help-block">{{ $errors->first('routesource') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('#idChucnang').select2({
                                        width: '100%',
                                        placeholder: '------Chọn------',
                                        allowClear: true
                                    });
                                });
                            </script>

                            <div class="col-lg-3">
                                <div class="form-group {{ $errors->has('idChucnang') ? 'has-error' : 'has-success' }}">
                                    <label class="col-lg-4 control-label">Chức năng</label>
                                    <div class="col-lg-6">
                                        <select class="form-control" name="idChucnang" id="idChucnang">
                                            <option value="default">---Chọn---</option>
                                            @foreach ($dsfunction as $fc)
                                                <option value="{{ $fc->IDCN }}">{{ $fc->TenCN }}</option>
                                            @endforeach
                                        </select>
                                        @error('idChucnang')
                                            <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-1">
                                <div class="form-group">
                                    <div class="col-lg-3">
                                        <button type="submit" name="them" class="btn btn-primary">Thêm</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="table-responsive">
                    <div class="container">
                        <div style="margin-top: 1em" class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="col-lg-8">
                                        <select class="form-control" id="selectChucnang">
                                            <option value="">Tất cả</option>
                                            @foreach ($dsfunction as $fc)
                                                <option value="{{ $fc->IDCN }}">{{ $fc->TenCN }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr style="background-color: #354b9f; color: white;">
                                    <th style="width: 5%; color: white">Tên pages</th>
                                    <th style="width: 5%; color: white">Tên route</th>
                                    <th style="width: 5%; color: white">Chức năng</th>
                                    <th style="width: 5%; color: white">Thao tác</th>
                                </tr>
                            </thead>

                            <tbody id="myTable">
                                @foreach ($dsdanhmuc as $item)
                                    <tr style=""
                                        data-chucnangid="{{ $item->chucnang ? $item->chucnang->IDCN : '' }}">
                                        <td style="width: 5%;">{{ $item->Route_title }}</td>
                                        <td style="width: 5%;">{{ $item->Route_name }}</td>
                                        <td style="width: 5%;">
                                            @if ($item->chucnang)
                                                {{ $item->chucnang->TenCN }}
                                            @else
                                                Chưa có chức năng
                                            @endif
                                        </td>
                                        <td style="width: 5%;">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <a href="{{ route('admin.routes.sua', ['id' => $item->ID]) }}"
                                                        class="btn btn-warning"><i class="dw dw-edit"></i>
                                                        Edit</a>
                                                </div>
                                                <div class="col-md-6">
                                                    <form action="{{ route('admin.routes.xoa', ['id' => $item->ID]) }}"
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
                </div>

                <script>
                    document.getElementById('selectChucnang').addEventListener('change', function() {
                        var danhMucId = this.value;
                        var rows = document.getElementById('myTable').getElementsByTagName('tr');
                        for (var i = 0; i < rows.length; i++) {
                            var row = rows[i];
                            var cell = row.getAttribute('data-chucnangid'); // Get the data attribute
                            if (cell) {
                                if (danhMucId === '' || cell === danhMucId) { // Compare with the data attribute
                                    row.style.display = '';
                                } else {
                                    row.style.display = 'none';
                                }
                            }
                        }
                    });
                </script>

                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-5 text-center">
                            <small class="text-muted inline m-t-sm m-b-sm">Showing
                                {{ $dsdanhmuc->firstItem() }}-{{ $dsdanhmuc->lastItem() }} of
                                {{ $dsdanhmuc->total() }} items | Page {{ $dsdanhmuc->currentPage() }} of
                                {{ $dsdanhmuc->lastPage() }}</small>
                        </div>
                        <div class="col-sm-7 text-right text-center-xs">
                            {{ $dsdanhmuc->links('pagination::bootstrap-4') }}
                        </div>
                    </div>


                </footer>
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
