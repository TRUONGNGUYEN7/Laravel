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
                        <li class="breadcrumb-item" aria-current="page">Danh mục bài viết</li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Your code to fade out the alert after 1 second
                setTimeout(function() {
                    $('.alert').fadeOut('slow');
                }, 1000); // hide the alerts after 1 second
            });
        </script>
        <style>
            /* Định dạng cho các alert */
            .alert {
                margin-bottom: 10px;
                /* Khoảng cách giữa các alert */
            }

            /* Đặt vị trí fixed cho các alert */
            .alert-fixed {
                position: fixed;
                top: 20px;
                /* Vị trí đứng từ top */
                left: 50%;
                /* Canh giữa theo chiều ngang */
                transform: translateX(-50%);
                /* Canh giữa theo chiều ngang */
                z-index: 9999;
                /* Đảm bảo alert luôn nổi lên trên cùng */
            }
        </style>

        @if (session('success'))
            <div class="alert alert-success alert-fixed">
                {{ session('success') }}
            </div>
        @endif

        {{-- @if ($errors->any())
            <div class="alert alert-danger alert-fixed">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif --}}


        <form action="{{ route('admin.danhmuc.store') }}" method="POST" class="form-horizontal ">
            {{ csrf_field() }}
            <div class="form-group has-success {{ $errors->has('tendanhmuc') ? 'has-error' : '' }}">
                <label class="col-lg-3 control-label">Tên danh mục</label>
                <div class="col-lg-6">
                    <input type="text" name="tendanhmuc" value="{{ old('tendanhmuc') }}" id="tendanhmuc"
                        class="form-control custom-width">
                    @if ($errors->has('tendanhmuc'))
                        <span class="help-block">{{ $errors->first('tendanhmuc') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group has-warning">
                <label class="col-lg-3 control-label">Trạng thái</label>
                <div class="form-group row">
                    <input type="checkbox" style="margin-left: 15px; margin-top: 11px" checked name="hienthi"
                        class="switch-btn" data-size="small" data-color="#0099ff">
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-offset-5 col-lg-6">
                    <button type="submit" name="them" class="btn btn-primary">Thêm</button>
                </div>
            </div>
        </form>
    </div>
@endsection
