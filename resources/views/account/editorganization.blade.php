@extends('layouts.master')

@section('title', 'Chỉnh sửa thông tin tổ chức')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('editorganization', ['id' => $organization->organization_id]) }}" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <div class="avatar" style="width: 100px; height: 100px; cursor: pointer;" onclick="document.getElementById('avatarInput').click()">
        <img src="{{ asset('images/' . $organization->avatar) }}" alt="Avatar" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
    </div>
    <input type="file" id="avatarInput" name="avatar" style="display: none;" accept="image/*">

    <h2>Chỉnh sửa thông tin tổ chức</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="form-group">
        <label for="username">Tên tài khoản *</label>
        <input type="text" name="username" value="{{ $organization->username }}" required>
    </div>

    <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" name="email" value="{{ $organization->email }}" required>
    </div>

    <div class="form-group">
        <label for="representative">Tên tổ chức *</label>
        <input type="text" name="representative" value="{{ $organization->representative }}" required>
    </div>

    <div class="form-group">
        <label for="phone">Số điện thoại</label>
        <input type="text" name="phone" value="{{ $organization->phone }}">
    </div>

    <div class="form-group">
        <label for="address">Địa chỉ</label>
        <input type="text" name="address" value="{{ $organization->address }}">
    </div>

   <div class="form-group">
    <label>Ngày thành lập</label>
    <input type="date" id="founded_at" name="founded_at" value="{{ old('founded_at', $organization->founded_at) }}">
    <span id="founded_at_error" style="color: red; display: none;">Ngày thành lập không được lớn hơn ngày hiện tại!</span>
</div>

    <div class="form-group">
        <label for="description">Mô tả</label>
        <textarea name="description">{{ $organization->description }}</textarea>
    </div>

     <!-- Cover Section -->
    <div class="form-group">
        <label>Chọn ảnh cover</label>
    </div>
    <div class="cover" style="width: 100%; cursor: pointer;" onclick="document.getElementById('coverInput').click()">
        @if ($organization->cover)
            <img src="{{ asset('images/' . $organization->cover) }}" alt="Cover" style="width: 100%; height: 200px; object-fit: cover;">
        @else
            <p>Click here to upload cover image</p>
        @endif
    </div>
    <input type="file" id="coverInput" name="cover" style="display: none;" accept="image/*">
</br>
    <div class="form-group">
        <label for="website">Website</label>
        <input type="url" name="website" value="{{ $organization->website }}">
    </div>

    <button type="submit" class="update-btn">Cập nhật</button>
</form>

</div>
@endsection

@section('bodyclass', 'editvolunteer')
<link rel="stylesheet" href="{{ asset('css/editvolunteer.css') }}">

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
</body>
