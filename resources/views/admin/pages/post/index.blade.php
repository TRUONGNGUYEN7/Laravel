@extends("$moduleName.admin")
@section('adcontent')
@include("$moduleName.elements.notify")
    <div class="row mb-3">
        <div class="col-md-4">
            <h3>{{ $pageTitle }}</h3>
        </div>
        <div class="col-md-8 d-flex justify-content-end align-items-center">
            <a href="{{ route("$controllerName/form") }}" class="btn btn-primary">Thêm mới</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 py-3">
            <div class="form-group d-flex justify-content-center">
                <input type="email" class="form-control" id="myInput" placeholder="Nhập nội dung tìm kiếm">
            </div>
        </div>
    </div>
    @include("$pathViewController.list")
@endsection
