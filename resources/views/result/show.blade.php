@extends('layouts.master')

@section('title', 'Chi tiết kết quả')

@section('styles')
<style>
    :root {
        --mainColor: #e74c3c;
        --secondary: #3498db;
        --success: #2ecc71;
        --warning: #f39c12;
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

    .event-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .back-button {
        background: transparent;
        border: none;
        color: var(--mainColor);
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

    .results-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .results-header {
        display: flex;
        position: relative;
    }

    .results-image-container {
        width: 50%;
        height: 400px;
        overflow: hidden;
        background-image: url('{{ $result->event->image ? asset($result->event->image) : "" }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .results-banner {
        display: none;
    }

    .results-header-content {
        width: 50%;
        background: var(--mainColor);
        color: #fff;
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .results-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .results-meta {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        color: rgba(255, 255, 255, 0.9);
        font-size: 15px;
    }

    .meta-item i {
        margin-right: 12px;
        width: 20px;
        text-align: center;
    }

    .results-content {
        padding: 30px;
    }

    .summary-card {
        background: rgba(231, 76, 60, 0.05);
        border-left: 4px solid var(--mainColor);
        padding: 20px;
        margin-bottom: 30px;
        border-radius: 4px;
    }

    .summary-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--mainColor);
        display: flex;
        align-items: center;
    }

    .summary-title i {
        margin-right: 10px;
    }

    .summary-text {
        color: var(--text-gray);
        line-height: 1.7;
    }

    .results-section {
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 20px;
        color: var(--dark-gray);
        display: flex;
        align-items: center;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--border-color);
    }

    .section-title i {
        margin-right: 10px;
        color: var(--mainColor);
    }

    .image-gallery {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 30px;
    }

    .gallery-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        transition: transform 0.3s;
        cursor: pointer;
    }

    .gallery-image:hover {
        transform: scale(1.03);
    }

    .event-info-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    @media (max-width: 768px) {
        .event-info-card {
            flex-direction: column !important;
        }

        .event-info-card>div {
            width: 100% !important;
        }
    }


    .event-thumbnail {
        width: 120px;
        height: 120px;
        border-radius: 8px;
        object-fit: cover;
        margin-right: 20px;
    }

    .event-details {
        flex-grow: 1;
    }

    .event-name {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--dark-gray);
    }

    .event-meta-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        color: var(--text-gray);
        font-size: 14px;
    }

    .event-meta-item i {
        color: var(--mainColor);
        width: 20px;
        text-align: center;
        margin-right: 8px;
    }

    .view-event-btn {
        padding: 10px 20px;
        background: var(--mainColor);
        color: #fff;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 10px;
        display: inline-flex;
        align-items: center;
    }

    .view-event-btn i {
        margin-right: 8px;
    }

    .view-event-btn:hover {
        background: #c0392b;
        transform: translateY(-2px);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: rgba(231, 76, 60, 0.1);
        color: var(--mainColor);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 15px;
        font-size: 24px;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: var(--dark-gray);
        margin-bottom: 5px;
    }

    .stat-label {
        color: var(--text-gray);
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .image-gallery {
            grid-template-columns: 1fr 1fr;
        }

        .results-header {
            flex-direction: column;
        }

        .results-image-container,
        .results-header-content {
            width: 100%;
        }

        .results-image-container {
            height: 250px;
        }

        .event-info-card,
        .event-info-card>div {
            flex-direction: column !important;
            width: 100% !important;
            text-align: center;
        }

        .event-info-card img {
            height: 250px !important;
            margin-bottom: 20px;
        }

        .event-meta-item i {
            margin-right: 12px !important;
        }
    }

    .comment-menu {
        position: absolute;
        top: 8px;
        right: 8px;
    }

    .comment-menu-dropdown {
        display: none;
        min-width: 80px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        padding: 4px 0;
        position: absolute;
        right: 0;
        top: 28px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        z-index: 100;
    }

    .btn-menu-toggle {
        background: none;
        border: none;
        cursor: pointer;
    }

    .btn-menu-toggle:focus {
        outline: none;
    }

    .btn-delete-comment {
        width: 100%;
        text-align: left;
        padding: 6px 16px;
        background: none;
        border: none;
        color: #e74c3c !important;
        cursor: pointer;
        font-size: 15px;
        font-weight: 500;
    }

    .btn-delete-comment:hover {
        background: #fbe9e7;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="event-header">
        <h1 class="page-title">Chi tiết kết quả</h1>
    </div>

    <div class="results-card">
        <div class="results-header">
            <div class="results-image-container">
                @php
                $firstImageRaw = $result->images
                ? trim(explode(';', $result->images)[0])
                : 'default-event.jpg';

                // Nếu đã có prefix 'images/', thì giữ nguyên
                $firstResultImage = str_starts_with($firstImageRaw, 'images/')
                ? $firstImageRaw
                : 'images/' . $firstImageRaw;
                @endphp

                <img src="{{ asset($firstResultImage) }}" alt="Ảnh kết quả" style="width: 100%; height: 100%; object-fit: cover;">

            </div>
            <!-- <div class="results-card">
            <div class="results-header">
                <div class="results-image-container" style="background-image: none;">
                    @php
                        $images = [];
                        if (!empty($result->event->images)) {
                            if (is_string($result->event->images)) {
                                $images = array_filter(explode(';', $result->event->images));
                            } elseif (is_array($result->event->images)) {
                                $images = $result->event->images;
                            }
                        }
                        $firstImage = !empty($images) ? $images[0] : 'default-event.jpg';
                    @endphp
                    <img src="{{ asset($firstImage) }}" alt="Banner kết quả sự kiện"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div> -->

            <div class="results-header-content">
                <h2 class="results-title">Kết quả sự kiện: {{ $result->event->name }}</h2>
                <div class="results-meta">
                    <div class="meta-item">
                        <i class="fas fa-building"></i>
                        <span>Tổ chức: {{ $result->event->organization->username }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-calendar-check"></i>
                        <span>Thời gian: {{ \Carbon\Carbon::parse($result->event->start_date)->format('d/m/Y') }} -
                            {{ \Carbon\Carbon::parse($result->event->end_date)->format('d/m/Y') }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Địa điểm: {{ $result->event->location }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-users"></i>
                        <span>Số lượng tình nguyện viên tham gia: {{ $result->event->quantity_now }}</span>
                    </div>

                </div>
            </div>
        </div>

        <div class="results-content">
            <div class="summary-card">
                <h3 class="summary-title">
                    <i class="fas fa-star"></i> Nội dung cụ thể
                </h3>
                <p class="summary-text">{{ $result->content }}</p>
            </div>

            <div class="results-section">
                <h3 class="section-title"><i class="fas fa-chart-line"></i> Thống kê</h3>
                @php
                $start = \Carbon\Carbon::parse($result->event->start_date);
                $end = \Carbon\Carbon::parse($result->event->end_date);
                $days = $end->diffInDays($start) + 1;
                @endphp
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                        <div class="stat-value">{{ $result->event->quantity_now }}</div>
                        <div class="stat-label">Tình nguyện viên tham gia</div>
                    </div>
                </div>
            </div>

            @if ($result->images)
            <div class="results-section">
                <h3 class="section-title"><i class="fas fa-images"></i> Hình ảnh hoạt động</h3>
                <div class="image-gallery">
                    @foreach (explode(';', $result->images) as $image)
                    <img src="{{ asset($image) }}" alt="Hình ảnh hoạt động" class="gallery-image">
                    @endforeach
                </div>
            </div>
            @endif

            <div class="results-section">
                <h3 class="section-title">
                    <i class="fas fa-clipboard-list"></i> Thông tin chi tiết sự kiện
                </h3>

                <div class="event-info-card" style="flex-direction: column;">
                    {{-- Ảnh sự kiện nằm trên cùng --}}
                    <div style="width: 100%; height: 350px; overflow: hidden; margin-bottom: 20px;">
                        @php
                        $firstEventImage = $result->event->images
                        ? trim(explode(';', $result->event->images)[0])
                        : 'default-event.jpg';
                        @endphp
                        <img src="{{ asset($firstEventImage) }}" alt="Ảnh sự kiện"
                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                    </div>

                    {{-- Thông tin sự kiện --}}
                    <div style="width: 100%; padding: 20px; box-sizing: border-box;">
                        <h4 style="font-size: 22px; font-weight: 700; margin-bottom: 20px;">{{ $result->event->name }}</h4>

                        <div class="event-meta-item" style="margin-bottom: 15px;">
                            <i class="fas fa-calendar"></i>
                            <span>{{ \Carbon\Carbon::parse($result->event->start_date)->format('d/m/Y') }} -
                                {{ \Carbon\Carbon::parse($result->event->end_date)->format('d/m/Y') }}</span>
                        </div>

                        <div class="event-meta-item" style="margin-bottom: 15px;">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $result->event->location }}</span>
                        </div>

                        <div class="event-meta-item" style="margin-bottom: 15px;">
                            <i class="fas fa-users"></i>
                            <span>Số người tham gia:
                                {{ $result->event->quantity_now }}/{{ $result->event->max_quantity }} người</span>
                        </div>

                        <div class="event-meta-item" style="margin-bottom: 15px;">
                            <i class="fas fa-building"></i>
                            <span>Tổ chức: {{ $result->event->organization->username }}</span>
                        </div>

                        <div class="event-meta-item" style="margin-bottom: 15px;">
                            <i class="fas fa-tag"></i>
                            <span>
                                @php
                                $status = $result->event->status;
                                $statusMap = [
                                'completed' => ['label' => 'Đã kết thúc', 'color' => '#95a5a6'],
                                'active' => ['label' => 'Mở đăng ký', 'color' => '#27ae60'],
                                'inactive' => ['label' => 'Không thể đăng ký', 'color' => '#27ae70'],
                                'open' => ['label' => 'Đang diễn ra', 'color' => '#2980b9'],
                                ];

                                $statusInfo = $statusMap[$status] ?? ['label' => ucfirst($status), 'color' => '#7f8c8d'];
                                @endphp

                                <span class="status-badge"
                                    style="background-color: {{ $statusInfo['color'] }}33; color: {{ $statusInfo['color'] }}; padding: 5px 12px; border-radius: 20px; font-size: 14px; font-weight: 600;">
                                    {{ $statusInfo['label'] }}
                                </span>

                            </span>
                        </div>

                        <div style="margin-top: 25px;">
                            <p style="margin-bottom: 20px; color: var(--text-gray); line-height: 1.6;">
                                {{ $result->event->description }}
                            </p>

                            <a href="{{ route('event.show', $result->event->event_id) }}" class="view-event-btn">
                                <i class="fas fa-external-link-alt"></i> Xem chi tiết sự kiện
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="results-section">
                <h3 class="section-title">
                    <i class="fas fa-comments"></i> Đánh giá
                </h3>

                @if (auth('volunteer')->check())
                <div class="comment-box d-flex align-items-start mb-4" style="gap: 12px;">
                    @php
                    $volunteer = auth('volunteer')->user();
                    $avatar = $volunteer->avatar
                    ? asset('images/' . $volunteer->avatar)
                    : '/api/placeholder/48/48?text=' . urlencode($volunteer->username);
                    @endphp
                    <img src="{{ $avatar }}" alt="Avatar" class="rounded-circle" width="48"
                        height="48" style="object-fit: cover;">
                    <form id="comment-form" action="{{ route('comment.store.ajax', $result->result_id) }}"
                        method="POST" class="flex-grow-1">
                        @csrf
                        <div class="d-flex align-items-center" style="gap: 16px;">
                            <textarea name="content" id="comment-content" class="form-control comment-input" rows="1"
                                placeholder="Viết bình luận..." required
                                style="resize: none; border-radius: 20px; padding: 10px 16px; background: #f0f2f5; border: 1px solid #e4e6eb;"></textarea>
                            <button type="submit" class="btn btn-ff5722"
                                style="border-radius: 20px; min-width: 80px; margin-left: 12px;">Gửi</button>
                        </div>
                    </form>
                </div>
                @else
                <div class="alert alert-warning">
                    Vui lòng <a href="{{ route('login') }}">đăng nhập </a>với tư cách TÌNH NGUYỆN VIÊN để bình luận.
                </div>
                @endif

                <!-- Danh sách bình luận -->
                <div class="comments-list" id="comments-container">
                    @foreach ($result->comments()->latest()->get() as $comment)
                    <div class="d-flex align-items-start mb-3 comment-item" style="gap: 12px; position: relative;"
                        data-comment-id="{{ $comment->id }}">
                        @php
                        $commentAvatar =
                        $comment->volunteer && $comment->volunteer->avatar
                        ? asset('images/' . $comment->volunteer->avatar)
                        : '/api/placeholder/40/40?text=' . urlencode($comment->name);
                        @endphp
                        <img src="{{ $commentAvatar }}" alt="Avatar" class="rounded-circle" width="40"
                            height="40" style="object-fit: cover;">
                        <div>
                            <div class="bg-light px-3 py-2 rounded-3" style="background: #f0f2f5;">
                                @if ($comment->volunteer)
                                <a href="{{ route('volunteer.profile', $comment->volunteer->volunteer_id) }}"
                                    class="fw-bold" style="color: #1976d2; text-decoration: none;">
                                    {{ $comment->name }}
                                </a>
                                @else
                                <span class="fw-bold">{{ $comment->name }}</span>
                                @endif
                                <div style="font-size: 15px;">{{ $comment->content }}</div>
                            </div>
                            <div style="font-size: 12px; color: #888; margin-top: 2px;">
                                {{ $comment->created_at->diffForHumans() }}
                            </div>
                        </div>
                        @if (auth('volunteer')->check() && $comment->volunteer_id == auth('volunteer')->id())
                        <div class="comment-menu" style="position: absolute; top: 8px; right: 8px;">
                            <button class="btn btn-link btn-menu-toggle"
                                style="padding: 0 8px; font-size: 20px; color: #3498db; background: none; border: none; cursor: pointer;">
                                &#8942;
                            </button>
                            <div class="comment-menu-dropdown">
                                <button class="btn btn-sm btn-delete-comment">Xóa</button>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Gallery giữ nguyên -->
<div id="imageModal" class="modal">
    <span class="modal-close">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

@if (session('error'))
<div class="alert alert-warning">
    {{ session('error') }}
</div>
@endif

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image gallery modal functionality
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        const galleryImages = document.querySelectorAll('.gallery-image');
        const closeBtn = document.querySelector('.modal-close');

        galleryImages.forEach(img => {
            img.addEventListener('click', function() {
                modal.style.display = "block";
                modalImg.src = this.src;
            });
        });

        closeBtn.addEventListener('click', function() {
            modal.style.display = "none";
        });

        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });

        // Ajax comment form
        const commentForm = document.getElementById('comment-form');
        if (commentForm) {
            commentForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const textarea = document.getElementById('comment-content');
                const content = textarea.value.trim();

                if (!content) return;

                const formData = new FormData(commentForm);
                const url = commentForm.getAttribute('action');

                fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Thêm comment mới vào danh sách
                            addNewComment(data.comment);
                            // Xóa nội dung textarea
                            textarea.value = '';
                        } else {
                            alert(data.message || 'Có lỗi xảy ra. Vui lòng thử lại.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    });
            });

            // Enter để gửi bình luận
            const textarea = commentForm.querySelector('textarea[name="content"]');
            textarea.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    commentForm.dispatchEvent(new Event('submit'));
                }
            });
        }

        // Hàm thêm comment mới vào DOM
        function addNewComment(comment) {
            const commentsContainer = document.getElementById('comments-container');
            let avatarUrl = '';
            if (comment.avatar) {
                avatarUrl = (comment.avatar.startsWith('/images/') || comment.avatar.startsWith('http')) ?
                    comment.avatar :
                    '/images/' + comment.avatar;
            } else {
                avatarUrl = '/api/placeholder/40/40?text=' + encodeURIComponent(comment.name);
            }
            const isMine = comment.is_mine ? true : false;
            const deleteMenu = isMine ?
                `<div class="comment-menu" style="position: absolute; top: 8px; right: 8px;">
                            <button class="btn btn-link btn-menu-toggle"
                                style="padding: 0 8px; font-size: 20px; color: #3498db; background: none; border: none; cursor: pointer;">
                                &#8942;
                            </button>
                            <div class="comment-menu-dropdown">
                                <button class="btn btn-sm btn-delete-comment">Xóa</button>
                            </div>
                        </div>` :
                '';
            const commentHtml = `
                    <div class="d-flex align-items-start mb-3 comment-item" style="gap: 12px; position: relative;" data-comment-id="${comment.id}">
                        <img src="${avatarUrl}" alt="Avatar" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                        <div>
                            <div class="bg-light px-3 py-2 rounded-3" style="background: #f0f2f5;">
                                <a href="/volunteer/${comment.volunteer_id}" class="fw-bold" style="color: #1976d2; text-decoration: none;">
                                    ${comment.name}
                                </a>
                                <div style="font-size: 15px;">${comment.content}</div>
                            </div>
                            <div style="font-size: 12px; color: #888; margin-top: 2px;">
                                ${comment.created_at}
                            </div>
                        </div>
                        ${deleteMenu}
                    </div>
                `;
            commentsContainer.insertAdjacentHTML('afterbegin', commentHtml);

            // Lấy đúng phần tử vừa thêm
            const newComment = commentsContainer.querySelector(`.comment-item[data-comment-id="${comment.id}"]`);
            if (!newComment) return;

            // Gắn sự kiện toggle menu cho nút ba chấm vừa thêm
            const menuToggle = newComment.querySelector('.btn-menu-toggle');
            const menuDropdown = newComment.querySelector('.comment-menu-dropdown');
            if (menuToggle && menuDropdown) {
                menuToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // Ẩn tất cả menu khác
                    document.querySelectorAll('.comment-menu-dropdown').forEach(menu => menu.style.display = 'none');
                    // Hiện menu của comment này
                    menuDropdown.style.display = (menuDropdown.style.display === 'block') ? 'none' : 'block';
                });
            }
            // Gắn lại sự kiện xóa cho nút Xóa vừa thêm
            const newDeleteBtn = newComment.querySelector('.btn-delete-comment');
            if (newDeleteBtn) {
                newDeleteBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    if (!confirm('Bạn có chắc muốn xóa bình luận này?')) return;
                    const commentDiv = this.closest('.comment-item');
                    const commentId = commentDiv.getAttribute('data-comment-id');
                    fetch(`/comment/${commentId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content'),
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                commentDiv.remove();
                            } else {
                                alert(data.message || 'Không thể xóa bình luận.');
                            }
                        });
                });
            }
        }

        // Toggle menu
        document.getElementById('comments-container').addEventListener('click', function(e) {
            // Toggle menu
            if (e.target.classList.contains('btn-menu-toggle')) {
                e.stopPropagation();
                // Ẩn tất cả menu khác
                document.querySelectorAll('.comment-menu-dropdown').forEach(menu => menu.style.display = 'none');
                // Hiện menu của comment này
                const menu = e.target.nextElementSibling;
                if (menu) {
                    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
                }
            }

            // Xóa comment
            if (e.target.classList.contains('btn-delete-comment')) {
                e.stopPropagation();
                if (!confirm('Bạn có chắc muốn xóa bình luận này?')) return;
                const commentDiv = e.target.closest('.comment-item');
                const commentId = commentDiv.getAttribute('data-comment-id');
                fetch(`/comment/${commentId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            commentDiv.remove();
                        } else {
                            alert(data.message || 'Không thể xóa bình luận.');
                        }
                    });
            }
        });

        // Ẩn menu khi click ra ngoài
        document.addEventListener('click', function() {
            document.querySelectorAll('.comment-menu-dropdown').forEach(menu => menu.style.display = 'none');
        });
    });
</script>
@endsection