@extends("$moduleName.admin")
@section('adcontent')
    <div class="row mb-3">
        <div class="col-md-8">
            <h3>{{ isset($item) ? 'Chỉnh sửa' : 'Thêm mới' }}</h3>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ route("$controllerName") }}" class="btn btn-primary">Quay lại</a>
        </div>
    </div>

    @include("$moduleName.elements.notify")

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="cardshadow">
                    <form method="POST"
                        action="{{ route("$controllerName/save") }}"
                        class="form-horizontal">
                        @csrf

                        <input type="hidden" class="form-control" name="id" id="id"
                            value="{{ isset($item) ? $item->id : '' }}">

                        <div class="mb-4 row">
                            <label for="name" class="col-sm-1 col-form-label">Tên danh mục</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ isset($item) ? $item->name : old('name') }}">

                                @if ($errors->has('name'))
                                    <div class="invalid">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="status" class="col-sm-1 col-form-label">Trạng thái</label>
                            <div class="col-sm-10">
                                <select id="status" class="form-control" name="status">
                                    <option value="active" {{ isset($item) && $item->status == 1 ? 'selected' : '' }}>Kích
                                        hoạt</option>
                                    <option value="inactive" {{ isset($item) && $item->status == 0 ? 'selected' : '' }}>
                                        Không
                                        kích hoạt</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <button type="submit" id="createQRButton"
                                class="btn btn-primary">{{ isset($item) ? 'Cập nhật' : 'Thêm' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/admin/js/form.js') }}"></script>
@endsection
