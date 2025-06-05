<div class="container mt-5">
    <h1 class="text-center mb-4">Chỉnh sửa chiến dịch</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('events.update', $event->event_id) }}" method="POST" enctype="multipart/form-data" class="event-form">
        @csrf
        @method('PUT')
        <input type="hidden" name="organization_id" value="{{ $event->organization_id }}">

        <!-- Header form kiểu Facebook -->
        <div class="form-header">
            <h5>Cập nhật thông tin chiến dịch</h5>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Tên chiến dịch <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $event->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả <span class="text-danger">*</span></label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                      required>{{ old('description', $event->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Row cho ngày tháng -->
        <div class="form-row">
            <div class="mb-3">
                <label for="start_date" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror"
                       value="{{ old('start_date', $event->start_date->format('Y-m-d')) }}" required>
                @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">Ngày kết thúc</label>
                <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror"
                       value="{{ old('end_date', $event->end_date ? $event->end_date->format('Y-m-d') : '') }}">
                @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Địa điểm <span class="text-danger">*</span></label>
            <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror"
                   value="{{ old('location', $event->location) }}" required>
            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Row cho số lượng -->
        <div class="form-row">
            <div class="mb-3">
                <label for="min_quantity" class="form-label">Số lượng tối thiểu <span class="text-danger">*</span></label>
                <input type="number" name="min_quantity" id="min_quantity" class="form-control @error('min_quantity') is-invalid @enderror"
                       value="{{ old('min_quantity', $event->min_quantity) }}" required min="1">
                @error('min_quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="max_quantity" class="form-label">Số lượng tối đa <span class="text-danger">*</span></label>
                <input type="number" name="max_quantity" id="max_quantity" class="form-control @error('max_quantity') is-invalid @enderror"
                       value="{{ old('max_quantity', $event->max_quantity) }}" required min="1">
                @error('max_quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Hiển thị ảnh hiện tại (nếu có) -->
         @php
            $images = is_array($event->images) ? $event->images : json_decode($event->images, true);
        @endphp

        @if ($images && count($images) > 0)
            <div class="mb-3">
                <label class="form-label">Hình ảnh đã tải lên:</label>
                <div class="row">
                    @foreach ($images as $image)
                        <div class="col-md-3 mb-2">
                            <img src="{{ asset('images/' . $image) }}" alt="Uploaded image" class="img-fluid rounded">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    
        {{-- @if($event->images && count($event->images) > 0)
        <div class="form-section-heading">Hình ảnh hiện tại</div>
        <div class="current-images">
            @foreach($event->images as $image)
            <div class="image-item">
                <img src="{{ asset('storage/' . $image->path) }}" alt="Event image">
                <button type="button" class="delete-btn" data-image-id="{{ $image->id }}" onclick="deleteImage({{ $image->id }})">×</button>
            </div>
            @endforeach
        </div>
        @endif --}}

        <div class="mb-3">
            <label for="images" class="form-label">Thêm hình ảnh mới</label>
            <div class="image-upload-hint">
                <i class="fa fa-image"></i> Chọn nhiều hình ảnh cùng lúc để minh họa cho chiến dịch
            </div>
            <input type="file" name="images[]" id="images" class="form-control @error('images') is-invalid @enderror" multiple>
            @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nút điều hướng -->
        <div class="form-footer">
            <a href="" class="btn btn-cancel">Hủy bỏ</a>
            <button type="submit" class="btn btn-primary">Cập nhật chiến dịch</button>
        </div>
    </form>
</div>

<style>
/* CSS cho form chiến dịch - Facebook-like Style - Áp dụng cho cả tạo mới và chỉnh sửa */
.event-form {
    background-color: #fff;
    padding: 1.25rem;
    border-radius: 0.75rem;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1), 0 2px 8px rgba(0, 0, 0, 0.08);
    max-width: 550px;
    margin: 0 auto;
    border: 1px solid #dddfe2;
}

/* Container chính */
.container {
    max-width: 650px !important;
}

/* Tiêu đề đẹp hơn */
.container h1 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1877f2;
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 0.5rem;
}

.container h1:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 3px;
    background-color: #1877f2;
    border-radius: 3px;
}

/* Thông báo */
.alert {
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    margin-bottom: 1rem;
    border: none;
}

.alert-success {
    background-color: #e7f3ff;
    color: #0a5fd9;
    border-left: 4px solid #1877f2;
}

.alert-danger {
    background-color: #ffebe9;
    color: #d8000c;
    border-left: 4px solid #fa383e;
}

.alert ul {
    padding-left: 1.25rem;
    margin-bottom: 0;
}

/* Form elements */
.event-form .form-label {
    font-weight: 500;
    color: #65676b;
    font-size: 0.875rem;
    margin-bottom: 0.3rem;
    display: block;
}

.event-form .form-control {
    padding: 0.5rem 0.75rem;
    border-radius: 0.5rem;
    border: 1px solid #dddfe2;
    transition: all 0.2s ease;
    font-size: 0.95rem;
    background-color: #f0f2f5;
}

.event-form .form-control:focus {
    border-color: #1877f2;
    box-shadow: 0 0 0 2px rgba(24, 119, 242, 0.2);
    background-color: #fff;
    outline: none;
}

.event-form .form-control.is-invalid {
    border-color: #fa383e;
    background-color: #fff;
    background-image: none;
}

.event-form .invalid-feedback {
    color: #fa383e;
    font-size: 0.8rem;
    margin-top: 0.25rem;
}

.event-form .text-danger {
    color: #fa383e !important;
}

.event-form .mb-3 {
    margin-bottom: 0.9rem;
}

/* Button styles */
.event-form button[type="submit"] {
    background-color: #1877f2;
    border: none;
    padding: 0.5rem 1.5rem;
    font-weight: 600;
    border-radius: 0.375rem;
    transition: all 0.2s ease;
    font-size: 0.95rem;
    color: #fff;
}

.event-form button[type="submit"]:hover {
    background-color: #166fe5;
}

.event-form button[type="submit"]:active {
    transform: scale(0.98);
}

/* Tùy chỉnh input file */
.event-form input[type="file"] {
    padding: 0.4rem 0.6rem;
    cursor: pointer;
    font-size: 0.9rem;
}

.event-form input[type="file"]::-webkit-file-upload-button {
    background-color: #e4e6eb;
    color: #050505;
    padding: 0.4rem 0.8rem;
    border: none;
    border-radius: 0.375rem;
    margin-right: 0.75rem;
    transition: all 0.2s ease;
    cursor: pointer;
    font-weight: 500;
    font-size: 0.9rem;
}

.event-form input[type="file"]::-webkit-file-upload-button:hover {
    background-color: #d8dadf;
}

/* Tùy chỉnh input date và number */
.event-form input[type="date"],
.event-form input[type="number"] {
    cursor: pointer;
    font-size: 0.95rem;
}

/* Textarea khung nhỏ hơn */
.event-form textarea {
    min-height: 100px;
    resize: vertical;
    max-height: 180px;
}

/* Header form giống Facebook */
.form-header {
    border-bottom: 1px solid #e4e6eb;
    margin: -1.25rem -1.25rem 1rem -1.25rem;
    padding: 0.75rem 1.25rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.form-header h5 {
    font-weight: 600;
    font-size: 1.1rem;
    margin: 0;
    color: #050505;
}

/* Form row để hiển thị nhiều field trên một hàng */
.form-row {
    display: flex;
    gap: 10px;
    margin-bottom: 0.5rem;
}

.form-row > div {
    flex: 1;
}

/* Responsive cho form dạng Facebook */
@media (max-width: 576px) {
    .container {
        padding: 0;
    }
    
    .container h1 {
        padding: 0 1rem;
    }
    
    .alert {
        border-radius: 0;
        margin-left: -15px;
        margin-right: -15px;
    }
    
    .event-form {
        max-width: 100%;
        margin: 0;
        border-radius: 0;
        box-shadow: none;
        padding: 1rem;
        border-left: none;
        border-right: none;
    }
    
    .form-row {
        flex-direction: column;
        gap: 0;
    }
}

/* Animation cho form */
@keyframes formAppear {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.event-form {
    animation: formAppear 0.3s ease forwards;
}

/* Hiện ảnh đã tải lên (cho trang edit) */
.current-images {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 1rem;
    padding: 0.75rem;
    background-color: #f0f2f5;
    border-radius: 0.5rem;
}

.current-images .image-item {
    position: relative;
    width: 100px;
    height: 100px;
    border-radius: 0.5rem;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}

.current-images .image-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.current-images .image-item .delete-btn {
    position: absolute;
    top: 5px;
    right: 5px;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 0.8rem;
    transition: background-color 0.2s;
}

.current-images .image-item .delete-btn:hover {
    background-color: rgba(0, 0, 0, 0.7);
}

/* Form section heading */
.form-section-heading {
    font-size: 1rem;
    font-weight: 600;
    color: #1877f2;
    margin: 1.25rem 0 0.75rem;
    padding-bottom: 0.35rem;
    border-bottom: 1px solid #e4e6eb;
}

/* Nút hủy bỏ */
.btn-cancel {
    background-color: #e4e6eb;
    color: #050505;
    border: none;
    padding: 0.5rem 1.5rem;
    font-weight: 500;
    border-radius: 0.375rem;
    transition: all 0.2s ease;
    font-size: 0.95rem;
    text-decoration: none;
    display: inline-block;
}

.btn-cancel:hover {
    background-color: #d8dadf;
    text-decoration: none;
    color: #050505;
}

/* Form footer */
.form-footer {
    display: flex;
    justify-content: space-between;
    margin-top: 1.5rem;
    padding-top: 1rem;
    border-top: 1px solid #e4e6eb;
}

/* Style cho gợi ý thêm ảnh */
.image-upload-hint {
    display: flex;
    align-items: center;
    padding: 0.5rem;
    background-color: #f0f2f5;
    border-radius: 0.5rem;
    margin-bottom: 0.75rem;
    color: #65676b;
    font-size: 0.9rem;
}

.image-upload-hint i {
    margin-right: 0.5rem;
    color: #1877f2;
}
</style>

<script>
// JavaScript để xóa ảnh
function deleteImage(imageId) {
    if (confirm('Bạn có chắc chắn muốn xóa ảnh này?')) {
        // Gửi Ajax request để xóa ảnh
        fetch(`/events/delete-image/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Xóa element ảnh khỏi DOM
                const imageElement = document.querySelector(`.image-item [data-image-id="${imageId}"]`).closest('.image-item');
                imageElement.remove();
                
                // Hiển thị thông báo
                alert('Xóa ảnh thành công!');
            } else {
                alert('Có lỗi xảy ra khi xóa ảnh.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi xóa ảnh.');
        });
    }
}

// Validate form trước khi submit
document.querySelector('.event-form').addEventListener('submit', function(e) {
    const minQty = parseInt(document.getElementById('min_quantity').value);
    const maxQty = parseInt(document.getElementById('max_quantity').value);
    
    if (minQty > maxQty) {
        e.preventDefault();
        alert('Số lượng tối thiểu không được lớn hơn số lượng tối đa!');
    }
    
    const startDate = new Date(document.getElementById('start_date').value);
    const endDate = document.getElementById('end_date').value ? new Date(document.getElementById('end_date').value) : null;
    
    if (endDate && startDate > endDate) {
        e.preventDefault();
        alert('Ngày bắt đầu không được sau ngày kết thúc!');
    }
});
</script>