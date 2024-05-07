<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách</h3>
    </div>
    <div class="card-body">
        <table id="" class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Tên chủ dề</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @php
                    $count = 1;
                @endphp
                @foreach ($ds as $key => $item)
                    <tr>
                        <th>{{ $count++ }}</th>
                        <td >{{ $item->name }}</td>
                        <td >{{ $item->danhmuc->name }}</td>
                        <td class="col-sm-2">
                            <div class="d-flex justify-content-center">
                                <a href="#" data-id="{{ $item->id }}"
                                    class="toggle-status-link {{ $item->status == 'inactive' ? 'hide-link' : 'show-link' }}">
                                    <i class="{{ $item->status == 'inactive' ? 'fas fa-eye-slash' : 'fas fa-eye' }}"
                                        id="status-icon-{{ $item->id }}"></i>
                                </a>
                            </div>
                        </td>
                        <td class="col-sm-2">
                            <div class="d-flex justify-content-center">
                                <div class="mr-3">
                                    <a href="{{ route("$controllerName/form", ['id' => $item->id]) }}"
                                        class="btn btn-warning"><i class="dw dw-edit"></i> Edit</a>

                                </div>
                                <div class="">
                                    <form action="{{ route("$controllerName/delete", ['id' => $item->id]) }}" method="get">
                                        @csrf
                                        <button type="submit" class="btn btn-danger show-alert-delete-box"
                                            data-toggle="tooltip" title='Delete'><i
                                                class="dw dw-delete-3"></i>Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <footer class="card-footer">
        <div class="row">
            <div class="col-md-10">
                <small class="text-muted inline m-t-sm m-b-sm">
                    Hiển thị {{ $ds->firstItem() }}-{{ $ds->lastItem() }} của {{ $ds->total() }} dòng | Trang
                    {{ $ds->currentPage() }} trang {{ $ds->lastPage() }}
                </small>
            </div>
            <div class="col-md-2 text-right">
                {{ $ds->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="{{ asset('assets/admin/js/list.js') }}"></script>
