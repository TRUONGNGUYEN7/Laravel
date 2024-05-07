<div id="signup-form-wrap">
    <div class="modal-header">
        <h5 class="modal-title">Đăng ký</h5>
        <button onclick="closeSignupForm()" class="close-button">&times;</button>
    </div>
    <form id="signup-form" data-action="{{ route('auth/signup_action') }}" method="POST">
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
        <p>
            <input type="text" id="confirm_password" name="confirm_password" placeholder="Password" required>
            <i class="validation"></i>
        </p>
        <p>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <i class="validation"></i>
        </p>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeSignupForm()">Đóng</button>

            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </div>
    </form>
    <div class="mb-4" id="create-account-wrap">
        <p>Đã có tài khoản? <a href="#" onclick="loginShowPopup()">Đăng nhập</a></p>
    </div>
</div>
