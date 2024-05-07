document.addEventListener('DOMContentLoaded', function () {
     const bannerImages = document.querySelector('.banner-images');
     const images = document.querySelectorAll('.banner-images img');

     let currentIndex = 0;

     function showNextImage() {
          currentIndex = (currentIndex + 1) % images.length;
          const translateValue = -currentIndex * 340;
          bannerImages.style.transform = `translateX(${translateValue}px)`;
     }

     setInterval(function () {
          showNextImage();
          setTimeout(function () {
               bannerImages.style.transition = 'none';
               setTimeout(function () {
                    bannerImages.style.transition = 'transform 1s ease-in-out';
               }, 10);
          }, 3000);
     }, 6000);
});