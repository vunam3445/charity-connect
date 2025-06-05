@extends('layouts.master')

@section('title', 'Chỉnh sửa thông tin cá nhân')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('editvolunteer', ['id' => $volunteer->volunteer_id]) }}" enctype="multipart/form-data">
    @csrf
    <h2>Chỉnh sửa thông tin cá nhân</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Avatar Section -->
    <div class="avatar" style="width: 100px; height: 100px; cursor: pointer;" onclick="document.getElementById('avatarInput').click()">
        <img src="{{ asset('images/' . $volunteer->avatar) }}" alt="Avatar" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
    </div>
    <input type="file" id="avatarInput" name="avatar" style="display: none;" accept="image/*">


    <!-- Username Section -->
    <div class="form-group">
        <label>Tên tài khoản *</label>
        <input type="text" name="username" value="{{ $volunteer->username }}" required>
    </div>

    <!-- Password Section (optional) -->
    
    <!-- Email Section -->
    <div class="form-group">
        <label>Email *</label>
        <input type="email" name="email" value="{{ $volunteer->email }}" required>
    </div>

    <!-- Phone Section -->
    <div class="form-group">
        <label>Số điện thoại</label>
        <input type="tel" name="phone" value="{{ $volunteer->phone }}">
    </div>

    <!-- Address Section -->
    <div class="form-group">
        <label>Địa chỉ</label>
        <textarea name="address">{{ $volunteer->address }}</textarea>
    </div>

    <!-- Cover Section -->
    <div class="form-group">
        <label>Chọn ảnh cover</label>
    </div>
    <div class="cover" style="width: 100%; cursor: pointer;" onclick="document.getElementById('coverInput').click()">
        @if ($volunteer->cover)
            <img src="{{ asset('images/' . $volunteer->cover) }}" alt="Cover" style="width: 100%; height: 200px; object-fit: cover;">
        @else
            <p>Click here to upload cover image</p>
        @endif
    </div>
    <input type="file" id="coverInput" name="cover" style="display: none;" accept="image/*">

    <button type="submit" class="update-btn">Cập nhật</button>
</form>

</div>


   {{-- Hiển thị lỗi validation (lấy lỗi đầu tiên) --}}
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
@endsection

@section('bodyclass', 'editvolunteer')
<link rel="stylesheet" href="{{ asset('css/editvolunteer.css') }}">
