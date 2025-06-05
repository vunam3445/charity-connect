<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
                <h1>Đăng ký</h1>
                <form class="login-form" action="{{ route('register') }}" method="POST">
                    @csrf

                    <label for="username">Tên</label>
                    <input type="username" id="username" name="username" placeholder="Nhập tên của bạn" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Nhập địa chỉ email" required>

                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>

                    <label for="password_confirmation">Nhập Lại Mật khẩu</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>

                    <label for="phone">Số điện thoại</label>
                    <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại của bạn" required>

                    <label for="address">Địa chỉ</label>
                    <input type="text" id="address" name="address" placeholder="Nhập địa chỉ của bạn" required>

                    <button type="submit">Đăng ký</button>
                    <span style="margin:10px auto;">Bạn đã có tài khoản? <a href="/login">Đăng nhập ngay</a></span>
                    <div style="margin-bottom: 15px; text-align: center;">
                        <a href="/registerOrganization">Đăng ký với tư cách tổ chức</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('
                success ') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: '{{ session('
                error ') }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif

    @if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi dữ liệu!',
                text: '{{ $errors->first() }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif
</body>

</html>