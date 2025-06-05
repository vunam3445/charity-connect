@extends('layouts.master')

@section('title', 'Chỉnh sửa kết quả')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-edit" style="margin-right: 10px;"></i>
                        Chỉnh sửa kết quả cho sự kiện: {{ $result->event->name }}
                    </h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('result.update', $result->result_id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4">
                            <label for="content" class="form-label fw-bold">
                                <i class="fas fa-align-left" style="margin-right: 10px;"></i>Nội dung
                            </label>
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="5" required placeholder="Nhập nội dung kết quả...">{{ old('content', $result->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="images" class="form-label fw-bold">
                                <i class="fas fa-images" style="margin-right: 10px;"></i>Hình ảnh mới (nếu muốn thay thế)
                            </label>
                            <div class="input-group">
                                <input type="file" name="images[]" id="images" class="form-control @error('images.*') is-invalid @enderror" multiple accept="image/jpeg,image/png,image/jpg,image/gif">
                                <button class="btn btn-outline-secondary" type="button" id="clearImages">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <small class="form-text text-muted mt-2">
                                <i class="fas fa-info-circle" style="margin-right: 6px;"></i>
                                Định dạng cho phép: JPEG, PNG, JPG, GIF. Kích thước tối đa: 2MB
                            </small>
                            @error('images.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="imagePreview" class="mt-3 d-flex flex-wrap gap-3"></div>
                        </div>

                        @if($result->images)
                            <div class="form-group mb-4">
                                <label class="fw-bold"><i class="fas fa-image" style="margin-right: 10px;"></i>Ảnh hiện tại:</label>
                                <div class="d-flex flex-wrap gap-3">
                                    @php
                                        $images = explode(',', $result->images);
                                    @endphp
                                    @foreach($images as $img)
                                        <img src="{{ asset('/' . trim($img)) }}" class="img-thumbnail rounded shadow-sm" style="width:150px; height:150px; object-fit:cover;">
                                    @endforeach
                                </div>
                                <small class="form-text text-muted">Chọn ảnh mới để thay thế toàn bộ ảnh cũ.</small>
                            </div>
                        @endif

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary px-4" style="margin-right: 30px;">
                                <i class="fas fa-arrow-left" style="margin-right: 15px;"></i>Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save" style="margin-right: 15px;"></i>Cập nhật kết quả
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/result-form.css') }}">
@endpush

@section()('scripts')
<script src="{{ asset('js/image-handler.js') }}"></script>
<script>
$(document).ready(function() {
    // Initialize image handler
    window.imageHandler = new ImageHandler();
    
    // Initialize form validation
    initializeFormValidation();
});
</script>
@endsection

</rewritten_file>