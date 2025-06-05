@extends('layouts.master')

@section('title', 'Chi tiết Kết quả')

@section('styles')
    <style>
        :root {
            --primary: #e67e22;
            --secondary: #2196f3;
            --success: #4caf50;
            --warning: #ff9800;
            --danger: #f44336;
            --light-gray: #f5f5f5;
            --dark-gray: #333;
            --text-gray: #666;
            --border-color: #ddd;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-gray);
            color: var(--dark-gray);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .result-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .back-button {
            background-color: transparent;
            border: none;
            color: var(--primary);
            font-size: 16px;
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-right: 15px;
        }

        .page-title {
            font-size: 22px;
            font-weight: 600;
            flex-grow: 1;
        }

        .admin-badge {
            background-color: var(--primary);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-left: 10px;
        }

        .result-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .result-top-section {
            display: flex;
            flex-direction: row;
        }

        .result-image-container {
            width: 50%;
            position: relative;
            overflow: hidden;
        }

        .result-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .image-navigation {
            position: absolute;
            bottom: 20px;
            left: 20px;
            display: flex;
            gap: 10px;
        }

        .image-nav-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
        }

        .image-nav-dot.active {
            background-color: white;
        }

        .result-info {
            width: 50%;
            padding: 20px;
        }

        .result-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--dark-gray);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .edit-btn {
            background-color: transparent;
            color: var(--primary);
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        .result-meta {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            color: var(--text-gray);
        }

        .meta-item i {
            margin-right: 8px;
            color: var(--primary);
            width: 20px;
            text-align: center;
        }

        .admin-buttons {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 15px !important;
            margin-bottom: 15px !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .btn {
            width: 100%;
            padding: 14px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-secondary {
            background-color: var(--secondary);
            color: white;
        }

        .btn-success {
            background-color: var(--success);
            color: white;
        }

        .btn-warning {
            background-color: var(--warning);
            color: white;
        }

        .btn-danger {
            background-color: #f44336 !important;
            color: white !important;
            z-index: 10;
            position: relative;
            opacity: 1 !important;
            visibility: visible !important;
            display: flex !important;
        }

        .btn-outline {
            background-color: white;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn i {
            margin-right: 8px;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .result-content {
            padding: 20px;
            line-height: 1.7;
            color: var(--text-gray);
            text-align: justify;
        }

        .result-details {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .details-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark-gray);
            display: flex;
            align-items: center;
        }

        .details-title i {
            margin-right: 10px;
            color: var(--primary);
        }

        .thumbnail-container {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            overflow-x: auto;
            padding: 10px 0;
        }

        .thumbnail {
            width: 80px;
            height: 60px;
            border-radius: 6px;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.2s ease;
        }

        .thumbnail.active {
            border-color: var(--primary);
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1050 !important;
            overflow-y: auto;
        }

        .modal-content {
            background-color: white;
            width: 90%;
            max-width: 700px;
            margin: 50px auto;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            padding: 20px;
            animation: modalFadeIn 0.3s ease-in-out;
            max-height: 90vh;
            overflow-y: auto;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--dark-gray);
        }

        .modal-close {
            background: transparent;
            border: none;
            font-size: 22px;
            cursor: pointer;
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            border-top: 1px solid var(--border-color);
            padding-top: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-gray);
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 16px;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .image-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .gallery-image {
            width: 100%;
            height: 150px;
            border-radius: 8px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-image:hover {
            transform: scale(1.05);
        }

        .statistics-section {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .statistics-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .statistics-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .statistics-label {
            color: var(--text-gray);
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .result-top-section {
                flex-direction: column;
            }

            .result-image-container,
            .result-info {
                width: 100%;
            }

            .result-image {
                height: 250px;
            }

            .statistics-section {
                grid-template-columns: 1fr;
            }
            
            .admin-buttons {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="result-header">
            <button class="back-button" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i> Quay lại
            </button>
            <h1 class="page-title">Chi tiết kết quả sự kiện</h1>
        </div>

        
        <div class="statistics-section">
            <div class="statistics-card">
                <div class="statistics-value">{{ $totalAttendees }}</div>
                <div class="statistics-label">Số người tham gia</div>
            </div>
            <div class="statistics-card">
                <div class="statistics-value">{{ $duration }} Ngày</div>
                <div class="statistics-label">Thời gian tổ chức</div>
            </div>
            <div class="statistics-card">
                <div class="statistics-value">{{ $totalComments }}</div>
                <div class="statistics-label">Bình luận</div>
            </div>
        </div>

        <div class="result-card">
            <div class="result-top-section">
                
                <div class="result-image-container">
                    @php
                        $firstImage = count($images) > 0 ? $images[0] : 'images/default-result.jpg';
                    @endphp
                    <img src="{{ asset($firstImage) }}" alt="Kết quả sự kiện" class="result-image" id="main-image">

                    
                    @if (count($images) > 1)
                        <div class="image-navigation">
                            @foreach ($images as $index => $image)
                                <div class="image-nav-dot {{ $index === 0 ? 'active' : '' }}"
                                    data-image="{{ asset($image) }}"></div>
                            @endforeach
                        </div>
                    @endif

                    
                    @if (count($images) > 1)
                        <div class="thumbnail-container">
                            @foreach ($images as $index => $image)
                                <img src="{{ asset($image) }}" class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                                    alt="Thumbnail {{ $index + 1 }}">
                            @endforeach
                        </div>
                    @endif
                </div>

                
                <div class="result-info">
                    <div class="result-title">
                        Kết quả sự kiện: {{ $event->name }}
                    </div>

                    <div class="result-meta">
                        <div class="meta-item">
                            <i class="fas fa-calendar-check"></i>
                            <span>Ngày tạo: {{ \Carbon\Carbon::parse($result->created_at)->format('d/m/Y H:i:s') }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-user"></i>
                            <span>Tổ chức: {{ $event->organization->username }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Địa điểm: {{ $event->location }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-users"></i>
                            <span>Số người tham gia: {{ $totalAttendees }}</span>
                        </div>
                    </div>

                    
                    @if(auth('organization')->check() && auth('organization')->user()->organization_id == $event->organization_id)
                        <div class="admin-buttons" style="display:grid !important; grid-template-columns: 1fr 1fr !important; gap: 15px !important; margin-bottom: 15px !important;">
                            <button type="button" class="btn btn-primary" id="editResultBtnModal" onclick="openModal('editResultModal')">
                                <i class="fas fa-edit"></i> Chỉnh sửa kết quả
                            </button>
                            <form action="{{ route('result.destroy', $result->result_id) }}" method="POST" onsubmit="return confirmDelete(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="width:100%">
                                    <i class="fas fa-trash"></i> Xóa kết quả
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>

            
            <div class="result-content">
                <h3 class="details-title">
                    <i class="fas fa-align-left"></i> Nội dung kết quả
                </h3>
                <p>{{ $result->content }}</p>
            </div>
        </div>

        
        @if(count($images) > 0)
            <div class="result-details">
                <h3 class="details-title">
                    <i class="fas fa-images"></i> Bộ sưu tập hình ảnh
                </h3>
                <div class="image-gallery">
                    @foreach ($images as $image)
                        <img src="{{ asset($image) }}" alt="Hình ảnh kết quả" class="gallery-image" data-full="{{ asset($image) }}">
                    @endforeach
                </div>
            </div>
        @endif

        
        <div class="result-details">
            <h3 class="details-title">
                <i class="fas fa-info-circle"></i> Thông tin sự kiện
            </h3>
            <div class="details-item" style="display: flex; margin-bottom: 15px;">
                <div class="details-icon" style="margin-right: 15px; background-color: rgba(230, 126, 34, 0.1); color: var(--primary); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div>
                    <div style="color: var(--text-gray); font-size: 14px;">Thời gian</div>
                    <div style="font-weight: 600;">{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</div>
                </div>
            </div>
            <div class="details-item" style="display: flex; margin-bottom: 15px;">
                <div class="details-icon" style="margin-right: 15px; background-color: rgba(230, 126, 34, 0.1); color: var(--primary); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <div style="color: var(--text-gray); font-size: 14px;">Địa điểm</div>
                    <div style="font-weight: 600;">{{ $event->location }}</div>
                </div>
            </div>
            <div class="details-item" style="display: flex; margin-bottom: 15px;">
                <div class="details-icon" style="margin-right: 15px; background-color: rgba(230, 126, 34, 0.1); color: var(--primary); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-align-left"></i>
                </div>
                <div>
                    <div style="color: var(--text-gray); font-size: 14px;">Mô tả</div>
                    <div style="font-weight: 600;">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</div>
                </div>
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('view.events', $event->event_id) }}" class="btn btn-primary" style="display: inline-block; width: auto; padding: 12px 25px;">
                    <i class="fas fa-external-link-alt"></i> Xem chi tiết sự kiện
                </a>
            </div>
        </div>
    </div>

    
    <div class="modal" id="editResultModal">
        <div class="modal-content" style="max-width: 800px;">
            <div class="modal-header bg-primary text-white" style="border-radius: 12px 12px 0 0;">
                <h3 class="modal-title mb-0" style="color: white;">
                    <i class="fas fa-edit" style="margin-right: 10px;"></i>
                    Chỉnh sửa kết quả cho sự kiện: {{ $event->name }}
                </h3>
                <button class="modal-close" data-dismiss="modal" style="color: white; background: transparent; border: none; font-size: 22px;">×</button>
            </div>
            <div class="modal-body p-4">
                <form id="editResultForm" action="{{ route('result.update', $result->result_id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                    <div class="form-group mb-4">
                        <label for="edit-content" class="form-label fw-bold">
                            <i class="fas fa-align-left" style="margin-right: 10px;"></i>Nội dung
                        </label>
                        <textarea name="content" id="edit-content" class="form-control @error('content') is-invalid @enderror" rows="5" required placeholder="Nhập nội dung kết quả...">{{ old('content', $result->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="form-group mb-4">
                        <label for="new-images" class="form-label fw-bold">
                            <i class="fas fa-images" style="margin-right: 10px;"></i>Hình ảnh mới (nếu muốn thay thế)
                        </label>
                        <div class="input-group">
                            <input type="file" name="images[]" id="new-images" class="form-control" multiple accept="image/jpeg,image/png,image/jpg,image/gif">
                        </div>
                        
                        <div id="imagePreview" class="mt-3 d-flex flex-wrap gap-3"></div>
                    </div>

                </form>
            </div>
            <div class="modal-footer" style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid #ddd; padding-top: 15px;">
                <button class="btn btn-secondary" data-dismiss="modal" style="padding: 10px 20px;">
                    <i class="fas fa-times" style="margin-right: 10px;"></i>Hủy
                </button>
                <button class="btn btn-primary" id="saveEditResultBtn" style="padding: 10px 20px;">
                    <i class="fas fa-save" style="margin-right: 10px;"></i>Cập nhật kết quả
                </button>
            </div>
        </div>
    </div>

    
    <div class="modal" id="imageViewerModal">
        <div class="modal-content" style="padding: 0; max-width: 90%; background-color: transparent; box-shadow: none;">
            <button class="modal-close" data-dismiss="modal" style="position: absolute; right: 10px; top: 10px; color: white; font-size: 30px; z-index: 10;">×</button>
            <img id="fullSizeImage" src="" alt="Full size image" style="width: 100%; height: auto; object-fit: contain; max-height: 80vh;">
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal handling functions
            function openModal(modalId) {
                document.getElementById(modalId).style.display = 'block';
                document.body.style.overflow = 'hidden';
            }

            function closeModal(modalId) {
                document.getElementById(modalId).style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            // Handle Edit Result button
            const editResultBtnModal = document.getElementById('editResultBtnModal');
            if (editResultBtnModal) {
                editResultBtnModal.addEventListener('click', function() {
                    openModal('editResultModal');
                });
            }

            // Image gallery click to show full size
            const galleryImages = document.querySelectorAll('.gallery-image');
            galleryImages.forEach(image => {
                image.addEventListener('click', function() {
                    const fullImg = document.getElementById('fullSizeImage');
                    fullImg.src = this.getAttribute('data-full');
                    openModal('imageViewerModal');
                });
            });

            // Image navigation for main image
            const imageDots = document.querySelectorAll('.image-nav-dot');
            const mainImage = document.getElementById('main-image');
            
            imageDots.forEach(dot => {
                dot.addEventListener('click', function() {
                    const imageSrc = this.getAttribute('data-image');
                    if (mainImage && imageSrc) {
                        mainImage.src = imageSrc;
                        
                        // Update active dot
                        imageDots.forEach(d => d.classList.remove('active'));
                        this.classList.add('active');
                    }
                });
            });

            // Handle thumbnail clicks
            const thumbnails = document.querySelectorAll('.thumbnail');
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    if (mainImage) {
                        mainImage.src = this.src;
                        
                        // Update active thumbnail
                        thumbnails.forEach(t => t.classList.remove('active'));
                        this.classList.add('active');
                    }
                });
            });

            // Close modals when clicking on close button
            const closeButtons = document.querySelectorAll('.modal-close');
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const modal = this.closest('.modal');
                    if (modal) {
                        closeModal(modal.id);
                    }
                });
            });

            // Close modals when clicking on cancel/close buttons in modal footer
            const cancelButtons = document.querySelectorAll('.modal-footer .btn-outline, .modal-footer .btn-secondary');
            cancelButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const modal = this.closest('.modal');
                    if (modal) {
                        closeModal(modal.id);
                    }
                });
            });

            // Close modals when clicking outside the modal content
            window.addEventListener('click', function(event) {
                const modals = document.querySelectorAll('.modal');
                modals.forEach(modal => {
                    if (event.target === modal) {
                        closeModal(modal.id);
                    }
                });
            });

            // Handle Save Edit Result button
            const saveEditResultBtn = document.getElementById('saveEditResultBtn');
            if (saveEditResultBtn) {
                saveEditResultBtn.addEventListener('click', function() {
                    const form = document.getElementById('editResultForm');
                    if (form) {
                        form.submit();
                    } else {
                        console.error("Form with ID 'editResultForm' not found!");
                    }
                });
            }

            // Image preview functionality for edit modal
            const imageInput = document.getElementById('new-images');
            const imagePreview = document.getElementById('imagePreview');

            if (imageInput && imagePreview) {
                imageInput.addEventListener('change', function() {
                    imagePreview.innerHTML = '';
                    
                    if (this.files) {
                        Array.from(this.files).forEach(file => {
                            if (file.type.startsWith('image/')) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.style.width = '100px';
                                    img.style.height = '100px';
                                    img.style.objectFit = 'cover';
                                    img.style.margin = '5px';
                                    img.style.borderRadius = '5px';
                                    imagePreview.appendChild(img);
                                }
                                reader.readAsDataURL(file);
                            }
                        });
                    }
                });
            }

            // Handle Clear Images button
            const clearImagesBtn = document.getElementById('clearImages');
            if (clearImagesBtn) {
                clearImagesBtn.addEventListener('click', function() {
                    const imageInput = document.getElementById('new-images');
                    const imagePreview = document.getElementById('imagePreview');
                    
                    if (imageInput) {
                        imageInput.value = "";
                    }
                    
                    if (imagePreview) {
                        imagePreview.innerHTML = "";
                    }
                });
            }

            // Form validation
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });

        function confirmDelete(event) {
            event.preventDefault();
            if (confirm('Bạn có chắc chắn muốn xóa kết quả này? Hành động này không thể hoàn tác.')) {
                event.target.submit();
            }
            return false;
        }
    </script>
@endsection