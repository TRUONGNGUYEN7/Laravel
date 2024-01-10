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
     @foreach ($dsdanhmucsua as $key => $value)

          <form action="{{ URL::to('/admin/baiviet/action_sua/' . $value->IDBV) }}" method="POST"
               enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                
          <div class="form-group has-success">
               <label class="col-lg-3 control-label">Tên bài viết</label>
               <div class="col-lg-6">
                    <input type="text" value="{{$value -> TenBV}}" name="tenbaiviet" placeholder="" class="form-control custom-width">
               </div>
          </div>

          <div class="form-group has-success">
               <label class="col-lg-3 control-label">Mô tả bài viết</label>
               <div class="col-lg-6">
                    <input type="text" value="{{$value -> Mota}}" name="mota" required placeholder="" id="mota" class="form-control custom-width">
               </div>
          </div>

          <div class="form-group has-success">
               <label class="col-lg-3 control-label">Hình ảnh mô tả</label>
               <div class="col-lg-6">
               <!-- Display current image -->
               @if ($value->HinhAnh)
                    <img src="{{asset("hinhanh/$value->HinhAnh")}}" alt="Current Image" class="img-thumbnail" style="max-width: 100%; height: 140px;">
                    <input type="hidden" value="{{$value -> HinhAnh}}" id="hinhanhcurrent" name="hinhanhcurrent" class="form-control" required>

                    @else
                    <p>No image available</p>
               @endif

               <!-- Allow users to upload a new image -->
                    <input type="file" value="{{$value -> HinhAnh}}" id="hinhanh" name="hinhanh" class="form-control" >
               </div>
          </div>
          <div class="form-group has-success">
               <label class="col-lg-3 control-label">Chủ đề</label>
               <div class="col-lg-6">
                    <select class="form-control" name="idchude" id="idchude">
                         @foreach ($dsdanhmucsua as $key => $item)
                              @if ($item->IDCD == $value->ChuDeID)
                                   <option value="{{ $item->IDCD }}" selected>{{ $item->TenChuDe }}</option>
                              @else
                                   <option value="{{ $item->IDCD }}">{{ $item->TenChuDe }}</option>
                              @endif
                         @endforeach

                    </select>
               </div>
          </div>

          <div class="form-group has-success">
               <label class="col-lg-3 control-label">Nội dung bài viết</label>
               <div class="col-lg-6">
                    <textarea class="ckeditor form-control" name="noidung">{!!$value -> NoiDung!!}</textarea>
                    </textarea>
               </div>
          </div>

          <div class="form-group has-warning">
               <label class="col-lg-3 control-label">Trạng thái</label>
               <div class="form-group row">
                    @if ($item -> TrangThaiBV == 1)
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