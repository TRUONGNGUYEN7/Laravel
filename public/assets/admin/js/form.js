
setTimeout(function () {
     $('#ntg-notification').fadeOut('fast');
}, 3000);

document.getElementById('logoInput').addEventListener('change', function (event) {
     var logoInput = event.target;
     var logoPreview = document.getElementById('logoPreview');
     if (logoInput.files && logoInput.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
               logoPreview.src = e.target.result;
          };
          reader.readAsDataURL(logoInput.files[0]);
     }
});


