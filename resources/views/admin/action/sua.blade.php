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

                // Display an alert message
                var message = "<?php echo Session::get('message'); ?>";
                if (message) {
                    alert(message);
                }
            });
        </script>

        @foreach ($dsroutesua as $key => $item)
            <form action="{{ route('admin.routes.update', ['id' => $item->ID]) }}" method="POST" class="form-horizontal ">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group {{ $errors->has('routetitle') ? 'has-error' : 'has-success' }}">
                    <label class="col-lg-3 control-label">Tên pages</label>
                    <div class="col-lg-6">
                        <input type="text" value="{{ $item->Route_title }}" name="routetitle" placeholder=""
                            class="form-control custom-width">
                        @if ($errors->has('routetitle'))
                            <span class="help-block">{{ $errors->first('routetitle') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('routesource') ? 'has-error' : 'has-success' }}">
                    <label class="col-lg-3 control-label">Đường dẫn</label>
                    <div class="col-lg-6">
                        <input type="text" value="{{ $item->Route_name }}" name="routesource" id="routesource"
                            placeholder="" class="form-control custom-width">
                        @if ($errors->has('routesource'))
                            <span class="help-block">{{ $errors->first('routesource') }}</span>
                        @endif
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

                <div class="form-group {{ $errors->has('idChucnang') ? 'has-error' : 'has-success' }}">
                    <label class="col-lg-3 control-label">Chức năng</label>
                    <div class="col-lg-6">
                        <select style="height: 45px;" class="form-control" name="idChucnang" id="idChucnang"
                            class="form-select">
                            @foreach ($dsfunction as $key => $fc)
                                @if ($fc->IDCN == $item->IDCN)
                                    <option value="{{ $fc->IDCN }}" selected>{{ $fc->TenCN }}</option>
                                @else
                                    <option value="{{ $fc->IDCN }}">{{ $fc->TenCN }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('idChucnang'))
                            <span class="help-block">{{ $errors->first('idChucnang') }}</span>
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
