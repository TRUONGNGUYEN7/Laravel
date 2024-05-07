@php
     $folderUpload = config('ntg.folderUpload.mainFolder');
     $fileUploadPath = '../' . $folderUpload . '/';
@endphp
<div>
     <div class="how2 how2-cl4 flex-s-c">
          <h3 class="f1-m-2 cl3 tab01-title">
               Quảng cáo
          </h3>
     </div>
     <ul class="p-t-35">

          <!-- Banner ads content goes here -->
          <div class="banner-container">
               <div class="banner-images">
                    <img src="{{ asset($fileUploadPath.'lixi.png')}}" alt="Advertisement Image 1">
                    <img src="{{ asset($fileUploadPath.'c1.png')}}" alt="Advertisement Image 2">
                    <img src="{{ asset($fileUploadPath.'ngoisao.png')}}" alt="Advertisement Image 3">
                    <!-- Add more images as needed -->
               </div>
          </div>

     </ul>
</div>
