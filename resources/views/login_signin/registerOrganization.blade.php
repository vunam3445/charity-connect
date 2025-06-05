<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Đăng Ký</title>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <h1>HUCE Charity</h1>
            <div class="image-area">
                <img src="https://play-lh.googleusercontent.com/Kp3CraY_UeXGkH8uN31lEswX5K8DOei5UOAlsXTFzM17cNt4KLx7FyJfyF8rj71iUKWm" alt="Jars and coins illustration">
            </div>
        </div>
        <div class="right-panel">
            <div class="box-login">
                <h1>chen</h1>
                <h1>Đăng ký</h1>
                <h1>Đăng ký</h1>
                <h1>Đăng ký</h1>
                <h1>Đăng ký</h1>
                <h1>Đăng ký</h1>
<form class="login-form" action="{{ route('register.organization') }}" method="POST">
    @csrf
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <label for="username">Tên tổ chức</label>
    <input type="text" id="username" name="username" placeholder="Nhập tên tổ chức" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Nhập địa chỉ email" required>

    <label for="password">Mật khẩu</label>
    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>

    <label for="password_confirmation">Nhập Lại Mật khẩu</label>
    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>

    <label for="phone">Số điện thoại liên hệ</label>
    <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại" required>

    <label for="address">Địa chỉ tổ chức</label>
    <input type="text" id="address" name="address" placeholder="Nhập địa chỉ" required>

     <label for="founded_at">Ngày thành lập</label>
    <input type="date" id="founded_at" name="founded_at" required>
    <span id="founded_at_error" style="color: red; display: none;">Ngày thành lập không thể lớn hơn ngày hiện tại!</span>

    <label for="representative">Người đại diện</label>
    <input type="text" id="representative" name="representative" placeholder="Nhập tên người đại diện" required>

    <label for="description">Mô tả về tổ chức</label>
    <textarea id="description" name="description" placeholder="Giới thiệu ngắn về tổ chức" rows="4"></textarea>

    <label for="website">Website</label>
    <input type="url" id="website" name="website" placeholder="Nhập địa chỉ website">

    <button type="submit">Đăng ký</button>

    <span style="margin:10px auto;">Bạn đã có tài khoản? <a href="/login">Đăng nhập ngay</a></span>

    <div style="margin-top: 15px; text-align: center;">
        <a href="{{ route('register.form') }}">Đăng ký với tư cách tình nguyện viên</a>
    </div>
</form>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Toastr -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false,
                position: 'center'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: "{{ session('error') }}",
                showConfirmButton: true,
                position: 'center'
            });
        @endif
    });
</script>
</body>
</html>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const foundedAtInput = document.getElementById('founded_at');
    const errorMessage = document.getElementById('founded_at_error');

    foundedAtInput.addEventListener('change', function() {
        const selectedDate = new Date(foundedAtInput.value);
        const currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0);  // Đảm bảo không so sánh theo giờ

        // Kiểm tra nếu ngày thành lập lớn hơn ngày hiện tại
        if (selectedDate > currentDate) {
            errorMessage.style.display = 'inline'; // Hiển thị thông báo lỗi
        } else {
            errorMessage.style.display = 'none'; // Ẩn thông báo lỗi
        }
    });
});
</script>
