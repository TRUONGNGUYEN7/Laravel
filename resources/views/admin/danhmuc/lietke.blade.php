@extends('admin')
@section('adcontent')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
     $(document).ready(function () {
          $("#myInput").on("keyup", function () {
          var value = $(this).val().toLowerCase();
          $("#myTable tr").filter(function () {
               $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
          });
     });
</script>

<div class="page-header">
     <div class="row">
          <div class="col-md-6 col-sm-12">
               <div class="title">

               </div>
               <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="#">Quản lý</a></li>
                         <li class="breadcrumb-item" aria-current="page">Danh mục bài viết</li>
                         <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
                    </ol>
               </nav>
          </div>
     </div>
</div>

<div class="card-box mb-30">
     <div class="table-agile-info">
               <div style="" class="panel panel-default">
                    <div class="row w3-res-tb">

                         <div class="col-sm-4">
                         </div>
                         <div class="col-sm-3">
                              <div class="input-group">
                                   <input type="text" id="myInput" style="width: 600px; height: 47px;margin-left:-130px" class="form-control" placeholder="Tìm kiếm....">
                              </div>
                         </div>
                    </div>
                    <div class="table-responsive">
                         <div class="container">
                              <table class="table table-striped b-t b-light">
                    <thead>
                         <tr style="background-color: #354b9f; color: white;">
                              <th style="width: 5%; color: white">Tên danh mục</th>
                              <th style="width: 5%; color: white">Trạng thái</th>
                              <th style="width: 5%; color: white">Thao tác</th>
                         </tr>
                    </thead>
                    <tbody id="myTable">
                         @foreach ($dsdanhmuc as $key => $item)
                         <tr style="background-color: #ebeefd; border-bottom: 1px double #fff;">
                              <td style="width: 5%;">{{$item->TenDanhMuc}}</td>
                              <td style="width: 5%;">
                                   <div style="width: 10px;">
                                        @if ($item->TrangThaiDM == 1)
                                        <a href="{{URL::to('/admin/danhmuc/hidden/'.$item->IDDM)}}">
                                             <input type="checkbox" checked name="hienthi" class="switch-btn" data-size="small" data-color="#0099ff">
                                        </a>
                                        @else
                                        <a href="{{URL::to('/admin/danhmuc/show/'.$item->IDDM)}}">
                                             <input type="checkbox" name="hienthi" class="switch-btn" data-size="small" data-color="#0099ff">
                                        </a>
                                        @endif
                                   </div>
                              </td>
                              <td style="width: 5%;">
                                   <div class="row">
                                        <div class="col-md-2">
                                        <a href="{{URL::to('admin/danhmuc/sua/'.$item->IDDM)}}" class="btn btn-warning"><i class="dw dw-edit"></i> Edit</a>
                                        </div>
                                        <div class="col-md-6">
                                        <form action="{{URL::to('/admin/danhmuc/xoa/'.$item->IDDM)}}" method="POST">
                                             @csrf
                                             <button type="submit" class="btn btn-danger show-alert-delete-box" data-toggle="tooltip" title='Delete'><i class="dw dw-delete-3"></i>Delete</button>
                                        </form>
                                        </div>
                                   </div>
                              </td>
                         </tr>
                         @endforeach
                    </tbody>
                    </table>

          </div>
     </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script type="text/javascript">
     $('.show-alert-delete-box').click(function(event) {
          var form = $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
               title: "Bạn chắc chắn muốn xóa?",
               text: "Nếu như xóa, dữ liệu sẽ không thể khôi phục",
               icon: "warning",
               type: "warning",
               buttons: ["Cancel", "Yes!"],
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Yes, delete it!'
          }).then((willDelete) => {
               if (willDelete) {
                    form.submit();
               }
          });
     });
</script>

@endsection