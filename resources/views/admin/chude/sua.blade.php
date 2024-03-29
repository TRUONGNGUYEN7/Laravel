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
                        <li class="breadcrumb-item" aria-current="page">Danh mục chủ đề</li>
                        <li class="breadcrumb-item active" aria-current="page">Sửa chủ đề</li>
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

        @foreach ($dschudesua as $key => $item)
            <form action="{{ route('admin.chude.update', ['id' => $item->IDCD]) }}" method="POST" class="form-horizontal ">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group {{ $errors->has('tenchude') ? 'has-error' : 'has-success' }}">
                    <label class="col-lg-3 control-label">Tên chủ đề</label>
                    <div class="col-lg-6">
                        <input type="text" value="{{ $item->TenChuDe }}" name="tenchude" placeholder=""
                            class="form-control custom-width">
                        @if ($errors->has('tenchude'))
                            <span class="help-block">{{ $errors->first('tenchude') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('idchude') ? 'has-error' : 'has-success' }}">
                    <label class="col-lg-3 control-label">Danh mục</label>
                    <div class="col-lg-6">
                        <select style="height: 45px;" class="form-control" name="iddanhmuc" id="iddanhmuc"
                            class="form-select">
                            @foreach ($dsdanhmuc as $key => $dm)
                                @if ($dm->IDDM == $item->DanhMucID)
                                    <option value="{{ $dm->IDDM }}" selected>{{ $dm->TenDanhMuc }}</option>
                                @else
                                    <option value="{{ $dm->IDDM }}">{{ $dm->TenDanhMuc }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('idchude'))
                            <span class="help-block">{{ $errors->first('idchude') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group has-warning">
                    <label class="col-lg-3 control-label">Trạng thái</label>
                    <div class="form-group row">
                        @if ($item->TrangThaiCD == 1)
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
