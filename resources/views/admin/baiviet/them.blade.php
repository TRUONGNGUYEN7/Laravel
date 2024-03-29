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
                        <li class="breadcrumb-item" aria-current="page">Bài viết</li>
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
        
        <form action="{{ route('admin.baiviet.store') }}" method="POST" enctype="multipart/form-data"
            class="form-horizontal ">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('tenbaiviet') ? 'has-error' : 'has-success' }}">
                <label class="col-lg-3 control-label">Tên bài viết</label>
                <div class="col-lg-6">
                    <input type="text" name="tenbaiviet" minlength="5" value="{{ old('tenbaiviet') }}" placeholder=""
                        id="tenbaiviet" class="form-control custom-width">
                    @if ($errors->has('tenbaiviet'))
                        <span class="help-block">{{ $errors->first('tenbaiviet') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('mota') ? 'has-error' : 'has-success' }}">
                <label class="col-lg-3 control-label">Mô tả bài viết</label>
                <div class="col-lg-6">
                    <input type="text" name="mota" value="{{ old('mota') }}" id="mota"
                        class="form-control custom-width">
                    @if ($errors->has('mota'))
                        <span class="help-block">{{ $errors->first('mota') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('hinhanhthem') ? 'has-error' : 'has-success' }}">
                <label class="col-lg-3 control-label">Hình ảnh mô tả</label>
                <div class="col-lg-6">
                    <input type="file" id="hinhanhthem" value="{{ old('hinhanhthem') }}" name="hinhanhthem" required
                        class="form-control custom-width">
                    @if ($errors->has('hinhanhthem'))
                        <span class="help-block">{{ $errors->first('hinhanhthem') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('noidung') ? 'has-error' : 'has-success' }}">
                <label class="col-lg-3 control-label">Nội dung bài viết</label>
                <div class="col-lg-6">
                    <textarea name="noidung" placeholder="" id="ckeditor" class="form-control">{{ old('noidung') }}</textarea>
                    @if ($errors->has('noidung'))
                        <span class="help-block">{{ $errors->first('noidung') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('idchude') ? 'has-error' : 'has-success' }}">
                <label class="col-lg-3 control-label">Chủ đề</label>
                <div class="col-lg-6 ">
                    <select class="form-control custom-width" name="idchude" id="idchude">
                        </option>
                        @foreach ($dschude as $key => $item)
                            <option value="{{ $item->IDCD }}" {{ old('idchude') == $item->IDCD ? 'selected' : '' }}>
                                {{ $item->TenChuDe }}
                            </option>
                        @endforeach
                    </select>
                    @error('idchude')
                        <div class="help-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $('#idchude').select2({
                        width: '100%',
                        placeholder: '------Chọn------',
                        allowClear: true
                    });
                });
            </script>

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
