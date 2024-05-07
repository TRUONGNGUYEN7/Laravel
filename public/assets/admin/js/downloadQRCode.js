
document.getElementById('downloadQRButton').addEventListener('click', function () {
     const qrCodeImageSrc = document.getElementById('qrCodeImage').src;
     fetch(qrCodeImageSrc)
          .then(response => response.blob())
          .then(blob => {
               const url = window.URL.createObjectURL(new Blob([blob]));
               const link = document.createElement('a');
               link.href = url;
               link.setAttribute('download', 'qr_code.png');
               document.body.appendChild(link);
               link.click();
          });
});
