$('.show-alert-delete-box').click(function (event) {
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

//search
$(document).ready(function() {
     $("#myInput").on("keyup", function () {
          var value = $(this).val().toLowerCase();
          $("#myTable tr").filter(function () {
               $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
     });
});

//popup
$(document).ready(function () {
     $('.image-link').click(function () {
          var imageSrc = $(this).data('image');
          var isLogo = $(this).data('is-logo');
          var modalTitle = isLogo ? 'Logo' : 'Hình ảnh';
          $('#imageModalLabel').text(modalTitle);
          $('#modalImage').attr('src', imageSrc);
     });
});

