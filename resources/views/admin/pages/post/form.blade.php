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
    @php
        $folderUpload = config('ntg.folderUpload.mainFolder');
        $fileUploadPath = '../' . $folderUpload . '/';
    @endphp
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="cardshadow">
                    <form method="POST" action="{{ route("$controllerName/save") }}" enctype="multipart/form-data"
                        class="form-horizontal">
                        @csrf

                        <input type="hidden" class="form-control" name="id" id="id"
                            value="{{ isset($item) ? $item->id : '' }}">

                        <div class="mb-4 row">
                            <label for="name" class="col-sm-1 col-form-label">Tên bài viết</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ isset($item) ? $item->name : old('name') }}" autocomplete="off">


                                @if ($errors->has('name'))
                                    <div class="invalid">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="describe" class="col-sm-1 col-form-label">Mô tả</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="describe" id="describe"
                                    value="{{ isset($item) ? $item->describe : old('describe') }}">

                                @if ($errors->has('describe'))
                                    <div class="invalid">{{ $errors->first('describe') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="content" class="col-sm-1 col-form-label">Nội dung</label>
                            <div class="col-sm-10">

                                <textarea name="content" id="content"> 
                                    @if (isset($item))
                                        @php
                                            $content = $item->content;
                                            $pattern = '/<img[^>]+src="([^">]+)"/';
                                            preg_match_all($pattern, $content, $matches);
                                            $imageUrls = $matches[1];
                                            foreach ($imageUrls as $imageUrl) {
                                                $content = str_replace($imageUrl, route('displayImages', ['fileName' => $imageUrl]), $content);
                                            }
                                        @endphp
                                                                                    {{ $content }}
                                        @else
                                        {{ old('content') }}
                                        @endif
                                    </textarea>
                                <script>
                                    ClassicEditor
                                        .create(document.querySelector('#content'), {
                                            ckfinder: {
                                                uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                                            },
                                        })
                                        .catch(error => {
                                            console.error(error);
                                        });
                                </script>

                                @if ($errors->has('content'))
                                    <div class="invalid">{{ $errors->first('content') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="image" class="col-sm-1 col-form-label">Hình ảnh</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="image" id="image"
                                    value="{{ isset($item) ? $item->image : old('image') }}">
                                @if (isset($item) && $item->imageHash)
                                    {{-- <img style="width: 100px;" id="qrCodeImage" src="{{ asset($fileUploadPath . $item['imageHash']) }}"
                                    alt="Hãy thêm hình!"> --}}

                                    <img style="width: 200px"
                                        src="{{ route('displayImages', ['fileName' => $item->imageHash]) }}"
                                        alt="Image">
                                @endif
                                @if ($errors->has('image'))
                                    <div class="invalid">{{ $errors->first('image') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="chudeID" class="col-sm-1 col-form-label">Chủ đề</label>
                            <div class="col-sm-10">
                                <select class="form-control custom-width" name="chudeID" id="chudeID">
                                    </option>
                                    @foreach ($ds as $key => $sl)
                                        <option value="{{ $sl->id }}"
                                            {{ isset($item) && $sl->id == $item->chudeID ? 'selected' : '' }}>
                                            {{ $sl->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="status" class="col-sm-1 col-form-label">Trạng thái</label>
                            <div class="col-sm-10">
                                <select id="status" class="form-control" name="status">
                                    <option value="active"
                                        {{ isset($item) && $item->status == 'active' ? 'selected' : '' }}>Kích
                                        hoạt</option>
                                    <option value="inactive"
                                        {{ isset($item) && $item->status == 'inactive' ? 'selected' : '' }}>
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

@endsection
