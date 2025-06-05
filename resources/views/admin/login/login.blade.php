<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Đăng Nhập Admin</title>
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
                <h1>Đăng nhập</h1>
                {{-- @if (session('success'))
                        <div id="custom-toast" class="toast-success">
                            <i class="bi bi-check-circle-fill toast-icon"></i>
                            <span>{{ session('success') }}</span>
            </div>
            @endif --}}

            <form class="login-form" action="{{ route('admin.login') }}" method="POST">
                @csrf
                <label for="email">UserName</label>
                <input type="text" id="username" name="username" placeholder="Nhập tài khoản admin" required>

                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>


                <button type="submit">Đăng nhập</button>

                {{-- <span style="margin:10px auto;">Bạn chưa có tài khoản? <a href="/register">Đăng ký ngay</a></span>
                    <div class="social-login">
                        
                        <div class="social-buttons">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjkiIGhlaWdodD0iMjgiIHZpZXdCb3g9IjAgMCAyOSAyOCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGcgY2xpcC1wYXRoPSJ1cmwoI2NsaXAwXzM1NDM5XzEyNTk2KSI+CjxwYXRoIGQ9Ik0yOC43NSAxNEMyOC43NSAyMC45ODggMjMuNjMwMiAyNi43Nzk5IDE2LjkzNzUgMjcuODI5OVYxOC4wNDY5SDIwLjE5OTZMMjAuODIwMyAxNEgxNi45Mzc1VjExLjM3MzlDMTYuOTM3NSAxMC4yNjY1IDE3LjQ4IDkuMTg3NSAxOS4yMTkxIDkuMTg3NUgyMC45ODQ0VjUuNzQyMTlDMjAuOTg0NCA1Ljc0MjE5IDE5LjM4MiA1LjQ2ODc1IDE3Ljg1MDIgNS40Njg3NUMxNC42NTI3IDUuNDY4NzUgMTIuNTYyNSA3LjQwNjg3IDEyLjU2MjUgMTAuOTE1NlYxNEg5LjAwNzgxVjE4LjA0NjlIMTIuNTYyNVYyNy44Mjk5QzUuODY5ODQgMjYuNzc5OSAwLjc1IDIwLjk4OCAwLjc1IDE0QzAuNzUgNi4yNjgyOCA3LjAxODI4IDAgMTQuNzUgMEMyMi40ODE3IDAgMjguNzUgNi4yNjgyOCAyOC43NSAxNFoiIGZpbGw9IiMxODc3RjIiLz4KPHBhdGggZD0iTTIwLjE5OTYgMTguMDQ2OUwyMC44MjAzIDE0SDE2LjkzNzVWMTEuMzczOUMxNi45Mzc1IDEwLjI2NjcgMTcuNDc5OSA5LjE4NzUgMTkuMjE5IDkuMTg3NUgyMC45ODQ0VjUuNzQyMTlDMjAuOTg0NCA1Ljc0MjE5IDE5LjM4MjMgNS40Njg3NSAxNy44NTA1IDUuNDY4NzVDMTQuNjUyNiA1LjQ2ODc1IDEyLjU2MjUgNy40MDY4OCAxMi41NjI1IDEwLjkxNTZWMTRIOS4wMDc4MVYxOC4wNDY5SDEyLjU2MjVWMjcuODI5OUMxMy4yNzUzIDI3Ljk0MTcgMTQuMDA1OCAyOCAxNC43NSAyOEMxNS40OTQyIDI4IDE2LjIyNDcgMjcuOTQxNyAxNi45Mzc1IDI3LjgyOTlWMTguMDQ2OUgyMC4xOTk2WiIgZmlsbD0id2hpdGUiLz4KPC9nPgo8ZGVmcz4KPGNsaXBQYXRoIGlkPSJjbGlwMF8zNTQzOV8xMjU5NiI+CjxyZWN0IHdpZHRoPSIyOCIgaGVpZ2h0PSIyOCIgZmlsbD0id2hpdGUiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAuNzUpIi8+CjwvY2xpcFBhdGg+CjwvZGVmcz4KPC9zdmc+Cg==" alt="Facebook" style="width: 50px; height: 50px;">
                            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjkiIGhlaWdodD0iMjgiIHZpZXdCb3g9IjAgMCAyOSAyOCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGcgY2xpcC1wYXRoPSJ1cmwoI2NsaXAwXzM1NDM5XzEyNjA2KSI+CjxwYXRoIGQ9Ik02LjQ1NTM5IDE2LjkyMDdMNS40ODA3NSAyMC41NTkyTDEuOTE4NDYgMjAuNjM0NkMwLjg1Mzg1OSAxOC42NiAwLjI1IDE2LjQwMDggMC4yNSAxNEMwLjI1IDExLjY3ODUgMC44MTQ1OTQgOS40ODkyIDEuODE1MzggNy41NjE1MkgxLjgxNjE0TDQuOTg3NTggOC4xNDI5Nkw2LjM3Njg2IDExLjI5NTRDNi4wODYwOSAxMi4xNDMxIDUuOTI3NiAxMy4wNTMxIDUuOTI3NiAxNEM1LjkyNzcxIDE1LjAyNzcgNi4xMTM4NyAxNi4wMTIzIDYuNDU1MzkgMTYuOTIwN1oiIGZpbGw9IiNGQkJCMDAiLz4KPHBhdGggZD0iTTI4LjAwNjIgMTEuMzg0OEMyOC4xNjcgMTIuMjMxNyAyOC4yNTA4IDEzLjEwNjMgMjguMjUwOCAxNC4wMDAxQzI4LjI1MDggMTUuMDAyNSAyOC4xNDU0IDE1Ljk4MDIgMjcuOTQ0NyAxNi45MjMyQzI3LjI2MzIgMjAuMTMyNSAyNS40ODI0IDIyLjkzNDggMjMuMDE1NSAyNC45MTc4TDIzLjAxNDcgMjQuOTE3MUwxOS4wMjAxIDI0LjcxMzNMMTguNDU0OCAyMS4xODRDMjAuMDkxNyAyMC4yMjQgMjEuMzcwOSAxOC43MjE3IDIyLjA0NDggMTYuOTIzMkgxNC41NTg2VjExLjM4NDhIMjIuMTU0SDI4LjAwNjJaIiBmaWxsPSIjNTE4RUY4Ii8+CjxwYXRoIGQ9Ik0yMy4wMTMzIDI0LjkxN0wyMy4wMTQxIDI0LjkxNzhDMjAuNjE0OSAyNi44NDYyIDE3LjU2NzIgMjguMDAwMSAxNC4yNDk1IDI4LjAwMDFDOC45MTc5NyAyOC4wMDAxIDQuMjgyNiAyNS4wMjAxIDEuOTE3OTcgMjAuNjM0N0w2LjQ1NDkgMTYuOTIwOUM3LjYzNzE5IDIwLjA3NjMgMTAuNjgxIDIyLjMyMjQgMTQuMjQ5NSAyMi4zMjI0QzE1Ljc4MzMgMjIuMzIyNCAxNy4yMjAzIDIxLjkwNzggMTguNDUzMyAyMS4xODRMMjMuMDEzMyAyNC45MTdaIiBmaWxsPSIjMjhCNDQ2Ii8+CjxwYXRoIGQ9Ik0yMy4xODcyIDMuMjIzMDZMMTguNjUxOCA2LjkzNjEzQzE3LjM3NTcgNi4xMzg0NSAxNS44NjcyIDUuNjc3NjYgMTQuMjUxIDUuNjc3NjZDMTAuNjAxOCA1LjY3NzY2IDcuNTAxMDEgOC4wMjY4NyA2LjM3Nzk1IDExLjI5NTRMMS44MTcxNyA3LjU2MTUzSDEuODE2NDFDNC4xNDY0MiAzLjA2OTIzIDguODQwMjUgMCAxNC4yNTEgMEMxNy42NDc5IDAgMjAuNzYyNiAxLjIxMDAyIDIzLjE4NzIgMy4yMjMwNloiIGZpbGw9IiNGMTQzMzYiLz4KPC9nPgo8ZGVmcz4KPGNsaXBQYXRoIGlkPSJjbGlwMF8zNTQzOV8xMjYwNiI+CjxyZWN0IHdpZHRoPSIyOCIgaGVpZ2h0PSIyOCIgZmlsbD0id2hpdGUiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAuMjUpIi8+CjwvY2xpcFBhdGg+CjwvZGVmcz4KPC9zdmc+Cg==" alt="Google" style="width: 50px; height: 50px;">
                        </div>
                    </div> --}}
            </form>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Toastr -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

{{-- <script>
    window.addEventListener('DOMContentLoaded', () => {
        const toast = document.getElementById('custom-toast');
        if (toast) {
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 500); // Xoá sau khi ẩn
            }, 4000); // Hiển thị 4s
        }
    });
</script> --}}

</html>