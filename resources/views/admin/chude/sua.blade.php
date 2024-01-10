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
     <?php
     $message = Session::get('message');
     if ($message) {
          echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
          Session::put('message', null);
     }
     ?>
     @foreach ($dsdanhmucsua as $key => $item)
     <form action="{{URL::to('/admin/chude/action_sua/'.$item -> IDCD  )}}" method="POST" class="form-horizontal ">
          {{ csrf_field() }}
          <div class="form-group has-success">
               <label class="col-lg-3 control-label">Tên chủ đề</label>
               <div class="col-lg-6">
                    <input type="text" value="{{$item -> TenChuDe}}" name="tenchude" placeholder="" class="form-control custom-width">
               </div>
          </div>

          <div class="form-group has-warning">
               <label class="col-lg-3 control-label">Danh mục sản phẩm</label>
               <div class="col-lg-6">
                    <select style="height: 45px;" class="form-control" name="iddanhmuc" id="iddanhmuc" class="form-select">
                         <option value="capnhat" selected>------đang cập nhật------</option>
                         <option selected value="{{ $item->DanhMucID }}">{{ $item->TenDanhMuc }}</option>
                    </select>
               </div>
          </div>

          <div class="form-group has-warning">
               <label class="col-lg-3 control-label">Trạng thái</label>
               <div class="form-group row">
                    @if ($item -> TrangThaiCD == 1)
                    <input type="checkbox" style="margin-left: 15px; margin-top: 11px" checked name="hienthi" class="switch-btn" data-size="small" data-color="#0099ff">
                    @else
                    <input type="checkbox" style="margin-left: 15px; margin-top: 11px" name="hienthi" class="switch-btn" data-size="small" data-color="#0099ff">
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