
function signUpShowPopup() {
     var signupForm = document.getElementById('signup-form-wrap');
     var loginForm = document.getElementById('login-form-wrap');
     var dimOverlay = document.getElementById('dim-overlay');

     signupForm.style.display = 'block';
     loginForm.style.display = 'none'; // Hide the login form
     dimOverlay.style.display = 'block'; // Show the dimming overlay
}

function loginShowPopup() {
     var signupForm = document.getElementById('signup-form-wrap');
     var loginForm = document.getElementById('login-form-wrap');
     var dimOverlay = document.getElementById('dim-overlay');

     loginForm.style.display = 'block';
     signupForm.style.display = 'none'; // Hide the signup form
     dimOverlay.style.display = 'block'; // Show the dimming overlay
}



function closeSignupForm() {
     var signupForm = document.getElementById('signup-form-wrap');
     var dimOverlay = document.getElementById('dim-overlay');

     signupForm.style.display = 'none';
     dimOverlay.style.display = 'none'; // Hide the dimming overlay
}

function closeLoginForm() {
     var loginForm = document.getElementById('login-form-wrap');
     var dimOverlay = document.getElementById('dim-overlay');

     loginForm.style.display = 'none';
     dimOverlay.style.display = 'none'; // Hide the dimming overlay
}

$(document).ready(function () {
     $('#signup-form').on('submit', function (e) {
          e.preventDefault();
          var actionUrl = $(this).data('action');
          // Perform AJAX request
          $.ajax({
               url: actionUrl,
               type: 'POST',
               headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data: $(this).serialize(),
               dataType: 'json',
               success: function (data) {
                    if (data.success) {
                         $('#signup-form-wrap').hide();
                         alert(data.message);
                         loginShowPopup();
                    } else {
                         alert(data.message); // Display error message
                    }
               },

               error: function (xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                    alert('Error during signup. Please try again.');
               }
          });
     });
});

$(document).ready(function () {
     $('#login-form').on('submit', function (e) {
          e.preventDefault();
          var actionUrl = $(this).data('action');
          // Perform AJAX request
          $.ajax({
               url: actionUrl,
               type: 'POST',
               headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data: $(this).serialize(),
               dataType: 'json',
               success: function (data) {
                    if (data.success) {
                         $('#login-form-wrap').hide();
                         location.reload();
                    } else {
                         alert('Tài khoản hoặc mật khẩu không đúng.');
                    }
               },
               error: function (xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                    alert('Error during login. Please try again.');
               }
          });
     });


});

//comment
$(document).ready(function () {
     $('#form-commen').on('submit', function (e) {
          e.preventDefault();
          var actionUrl = $(this).data('action');
          // Perform AJAX request
          $.ajax({
               url: actionUrl,
               type: 'POST',
               headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data: $(this).serialize(),
               dataType: 'json',
               success: function (data) {
                    if (data.success) {
                         $('#signup-form-wrap').hide();
                         alert(data.message);
                         loginShowPopup();
                    } else {
                         alert(data.message); // Display error message
                    }
               },

               error: function (xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                    alert('Error during signup. Please try again.');
               }
          });
     });
});
