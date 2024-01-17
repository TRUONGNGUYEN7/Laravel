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
                            <li class="breadcrumb-item" aria-current="page">Chủ đề</li>
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
        <form action="{{ route('admin.chude.action_them') }}" method="POST" class="form-horizontal ">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('tenchude') ? 'has-error' : 'has-success' }}">
                <label class="col-lg-3 control-label">Tên chủ đề</label>
                <div class="col-lg-6">
                    <input type="text" name="tenchude" value="{{ old('tenchude') }}" id="tenchude" class="form-control custom-width">
                    @if ($errors->has('tenchude'))
                        <span class="help-block">{{ $errors->first('tenchude') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('idchude') ? 'has-error' : 'has-success' }}">
                <label class="col-lg-3 control-label">Danh mục</label>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <select class="form-control" name="idchude" id="idchude">
                            <option value="chude" {{ old('idchude') == 'chude' ? 'selected' : '' }}>------Chọn------</option>
                            @foreach ($dsdanhmuc as $key => $item)
                                <option value="{{ $item->IDDM }}" {{ old('idchude') == $item->IDDM ? 'selected' : '' }}>
                                    {{ $item->TenDanhMuc }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('idchude'))
                            <span class="help-block">{{ $errors->first('idchude') }}</span>
                        @endif
                    </div>
                </div>
            </div>

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
