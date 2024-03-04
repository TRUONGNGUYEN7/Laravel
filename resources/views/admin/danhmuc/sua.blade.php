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
                    <li class="breadcrumb-item active" aria-current="page">Sửa danh mục</li>
                    </ol>
               </nav>
          </div>
     </div>
</div>
<div class="panel-body">
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

     @foreach ($dsdanhmuc as $key => $item)
          <form action="{{ route('admin.danhmuc.update', ['id' => $item->IDDM]) }}" method="POST"
               class="form-horizontal ">
               {{ csrf_field() }}
               {{ method_field('PUT') }}
               <div class="form-group has-success {{ $errors->has('tendanhmuc') ? 'has-error' : '' }}">
                    <label class="col-lg-3 control-label">Tên danh mục</label>
                    <div class="col-lg-6">
                    <input type="text" value="{{ $item->TenDanhMuc }}" name="tendanhmuc" placeholder=""
                         class="form-control custom-width">
                    @if ($errors->has('tendanhmuc'))
                         <span class="help-block">{{ $errors->first('tendanhmuc') }}</span>
                    @endif
                    </div>
               </div>

               <div class="form-group has-warning">
                    <label class="col-lg-3 control-label">Trạng thái</label>
                    <div class="form-group row">
                    @if ($item->TrangThaiDM == 1)
                         <input type="checkbox" style="margin-left: 15px; margin-top: 11px" checked name="hienthi"
                              class="switch-btn" data-size="small" data-color="#0099ff">
                    @else
                         <input type="checkbox" style="margin-left: 15px; margin-top: 11px" name="hienthi"
                              class="switch-btn" data-size="small" data-color="#0099ff">
                    @endif
                    </div>
               </div>
               <div class="form-group">
                    <div class="col-lg-offset-5 col-lg-6">
                    <button type="submit" name="capnhat" class="btn btn-primary">Sửa</button>
                    </div>
               </div>
          </form>
     @endforeach
</div>
@endsection
