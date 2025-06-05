<form id="createEventForm" action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="event-form">
    @csrf
    <input type="hidden" name="organization_id" value="{{ $organizationId }}">

    <div class="mb-3">
        <label for="name" class="form-label">Tên chiến dịch <span class="text-danger">*</span></label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Mô tả <span class="text-danger">*</span></label>
        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                  required>{{ old('description') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="start_date" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
        <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror"
               value="{{ old('start_date') }}" required>
        @error('start_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="end_date" class="form-label">Ngày kết thúc</label>
        <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror"
               value="{{ old('end_date') }}">
        @error('end_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="location" class="form-label">Địa điểm <span class="text-danger">*</span></label>
        <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror"
               value="{{ old('location') }}" required>
        @error('location')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="min_quantity" class="form-label">Số lượng tối thiểu <span class="text-danger">*</span></label>
        <input type="number" name="min_quantity" id="min_quantity" class="form-control @error('min_quantity') is-invalid @enderror"
               value="{{ old('min_quantity') }}" required min="1">
        @error('min_quantity')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="max_quantity" class="form-label">Số lượng tối đa <span class="text-danger">*</span></label>
        <input type="number" name="max_quantity" id="max_quantity" class="form-control @error('max_quantity') is-invalid @enderror"
               value="{{ old('max_quantity') }}" required min="1">
        @error('max_quantity')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="images" class="form-label">Hình ảnh</label>
        <input type="file" name="images[]" id="images" class="form-control @error('images') is-invalid @enderror" multiple>
        @error('images')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Tạo chiến dịch</button>
</form>


<style>
   /* CSS cho form tạo chiến dịch - Facebook-like Style */
.event-form {
    background-color: #fff;
    padding: 1.25rem;
    border-radius: 0.75rem;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1), 0 2px 8px rgba(0, 0, 0, 0.08);
    max-width: 550px;
    margin: 0 auto;
    border: 1px solid #dddfe2;
}

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

.event-form button[type="submit"] {
    background-color: #1877f2;
    border: none;
    padding: 0.5rem 1rem;
    font-weight: 600;
    border-radius: 0.375rem;
    transition: all 0.2s ease;
    font-size: 0.95rem;
    width: 100%;
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

/* Tùy chỉnh input date */
.event-form input[type="date"],
.event-form input[type="number"] {
    cursor: pointer;
    font-size: 0.95rem;
}

/* Textarea khung nhỏ hơn */
.event-form textarea {
    min-height: 70px;
    resize: vertical;
    max-height: 150px;
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

.form-header button.close {
    background: none;
    border: none;
    font-size: 1.5rem;
    line-height: 1;
    color: #65676b;
    padding: 0;
    cursor: pointer;
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

/* Responsive cho form dạng Facebook */
@media (max-width: 576px) {
    .event-form {
        max-width: 100%;
        margin: 0;
        border-radius: 0;
        box-shadow: none;
        padding: 1rem;
    }
    
    .form-header {
        margin: -1rem -1rem 1rem -1rem;
        padding: 0.5rem 1rem;
    }
}

/* Style cho các field theo chiều ngang */
.form-row {
    display: flex;
    gap: 10px;
    margin-bottom: 0.5rem;
}

.form-row > div {
    flex: 1;
}

/* Tùy chỉnh footer form */
.form-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1rem;
    padding-top: 0.75rem;
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

/* Tối ưu thêm cho modal */
#createEventModal .modal-content {
    border-radius: 0.75rem;
    border: none;
    overflow: hidden;
}

#createEventModal .modal-body {
    padding: 0;
}

#createEventModal .event-form {
    box-shadow: none;
    border: none;
    border-radius: 0;
    max-width: 100%;
    margin: 0;
}
</style>
