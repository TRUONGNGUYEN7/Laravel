<div id="login-form-wrap">
    <div class="modal-header">
        <h5 class="modal-title">Đăng nhập</h5>
        <button onclick="closeLoginForm()" class="close-button">&times;</button>
    </div>

    <form id="login-form" data-action="{{ route('auth/signin_action') }}" method="POST">
        {{ csrf_field() }}
        <p>
            <input type="text" id="name" name="name" onfocus="checkAndShowPopup()" placeholder="Username"
                required>
            <i class="validation"></i>
        </p>
        <p>
            <input type="text" id="password" name="password" placeholder="Password" required>
            <i class="validation"></i>
        </p>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeLoginForm()">Đóng</button>
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </div>
    </form>
       <div class="mb-4" id="create-account-wrap">
        <p>Chưa có tài khoản? <a href="#" onclick="signUpShowPopup()">Tạo tài khoản</a></p>
    </div>

</div>
