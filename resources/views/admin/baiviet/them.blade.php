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
        <?php
            $message = Session::get('message');
            if ($message) {
                echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
                Session::put('message', null);
            }
        ?>
        <form action="{{ URL::to('/admin/baiviet/action_them') }}" method="POST" enctype="multipart/form-data"  class="form-horizontal ">
            {{ csrf_field() }}
            <div class="form-group has-success">
                <label class="col-lg-3 control-label">Tên bài viết</label>
                <div class="col-lg-6">
                    <input type="text" name="tenbaiviet" required minlength="5" placeholder="" id="tendanhmuc" class="form-control custom-width">
                </div>
            </div>

            <div class="form-group has-success">
                <label class="col-lg-3 control-label">Mô tả bài viết</label>
                <div class="col-lg-6">
                    <input type="text" name="mota" required placeholder="" id="mota" class="form-control custom-width">
                </div>
            </div>

            <div class="form-group has-success">
                <label class="col-lg-3 control-label">Hình ảnh mô tả</label>
                <div class="col-lg-6">
                    <input type="file" class="form-control" id="hinhanh" name="hinhanh" required class="form-control custom-width">
                </div>
            </div>

            <div class="form-group has-success">
                <label class="col-lg-3 control-label">Nội dung bài viết</label>
                <div class="col-lg-6">
                    <textarea type="text" name="noidung" placeholder="" id="ckeditor" class="form-control">
                    </textarea>
                </div>
            </div>

            <div class="form-group has-success">
                <label class="col-lg-3 control-label">Chủ đề</label>
                <div class="col-lg-6">
                    <select class="form-control custom-width" name="idchude" id="idchude">
                        <option value="capnhat" selected>------ Chọn ------</option>
                        @foreach ($dschude as $key => $item)
                            <option value="{{ $item->IDCD }}">{{ $item->TenChuDe }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <script>
                const email = document.getElementById("mota");
                email.addEventListener("input", (event) => {
                    if (email.validity.typeMismatch) {
                        email.setCustomValidity("Điền địa chỉ email!");
                    } else {
                        email.setCustomValidity("");
                    }
                });
            </script>
            <div class="form-group has-warning">
                <label class="col-lg-3 control-label">Trạng thái</label>
                <div class="form-group row">
                    <input type="checkbox" style="margin-left: 15px; margin-top: 11px" checked name="hienthi" class="switch-btn" data-size="small" data-color="#0099ff">
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
