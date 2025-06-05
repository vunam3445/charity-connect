@extends('layouts.master')

@section('title', $event->name . ' - Chi tiết sự kiện')

@section('styles')
<style>
    /* Tăng độ ưu tiên với !important nếu cần */
    .th-event-container * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    :root {
        --th-primary: #e74c3c;
        --th-secondary: #3498db;
        --th-success: #2ecc71;
        --th-warning: #f39c12;
        --th-light-gray: #f5f5f5;
        --th-dark-gray: #333;
        --th-text-gray: #666;
        --th-border-color: #ddd;
    }

    .th-event-container {
        background-color: var(--th-light-gray);
        color: var(--th-dark-gray);
        line-height: 1.6;
        display: block;
        min-height: 100vh;
    }

    .th-event-container .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .th-event-container .event-card {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 20px;
        display: block;
    }

    .th-event-container .event-top-section {
        display: flex;
        flex-direction: row;
    }

    .th-event-container .event-image-container {
        width: 50%;
        position: relative;
        overflow: hidden;
    }

    .th-event-container .event-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .th-event-container .image-navigation {
        position: absolute;
        bottom: 20px;
        left: 20px;
        display: flex;
        gap: 10px;
    }

    .th-event-container .image-nav-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        cursor: pointer;
    }

    .th-event-container .image-nav-dot.active {
        background-color: white;
    }

    .th-event-container .event-info {
        width: 50%;
        padding: 20px;
        display: block;
    }

    .th-event-container .event-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--th-dark-gray);
    }

    .th-event-container .event-meta {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 20px;
    }

    .th-event-container .meta-item {
        display: flex;
        align-items: center;
        color: var(--th-text-gray);
    }

    .th-event-container .meta-item i {
        margin-right: 8px;
        color: var(--th-primary);
        width: 20px;
        text-align: center;
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
    }

    .th-event-container .event-progress {
        margin-bottom: 25px;
        display: block;
    }

    .th-event-container .progress-title {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .th-event-container .progress-bar {
        height: 12px;
        background-color: #eee;
        border-radius: 6px;
        overflow: hidden;
    }

    .th-event-container .progress-fill {
        height: 100%;
        background-color: var(--th-primary);
        width: 0%;
    }

    .th-event-container .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .th-event-container .btn {
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

    .th-event-container .btn-primary {
        background-color: var(--th-primary);
        color: white;
    }

    .th-event-container .btn-outline {
        background-color: white;
        color: var(--th-primary);
        border: 1px solid var(--th-primary);
    }

    .th-event-container .btn-cancel {
        background-color: white;
        color: #e74c3c;
        border: 1px solid #e74c3c;
    }

    .th-event-container .btn-results {
        background-color: white;
        color: var(--th-secondary);
        border: 1px solid var(--th-secondary);
    }

    .th-event-container .btn i {
        margin-right: 8px;
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
    }

    .th-event-container .btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    .th-event-container .event-description {
        padding: 20px;
        line-height: 1.7;
        color: var(--th-text-gray);
        text-align: justify;
        display: block;
    }

    .th-event-container .event-details {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        display: block;
    }

    .th-event-container .details-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        color: var(--th-dark-gray);
        display: flex;
        align-items: center;
    }

    .th-event-container .details-title i {
        margin-right: 10px;
        color: var(--th-primary);
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
    }

    .th-event-container .details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .th-event-container .details-item {
        display: flex;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--th-border-color);
    }

    .th-event-container .details-icon {
        width: 40px;
        height: 40px;
        background-color: rgba(231, 76, 60, 0.1);
        color: var(--th-primary);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .th-event-container .details-icon i {
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
    }

    .th-event-container .details-content {
        flex-grow: 1;
    }

    .th-event-container .details-label {
        font-size: 14px;
        color: var(--th-text-gray);
        margin-bottom: 5px;
    }

    .th-event-container .details-content .details-value {
        font-weight: 600;
        color: var(--th-dark-gray);
    }

    .th-event-container .status-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    .th-event-container .status-active {
        background-color: rgba(46, 204, 113, 0.15);
        color: #27ae60;
    }

    .th-event-container .status-pending {
        background-color: rgba(243, 156, 18, 0.15);
        color: #f39c12;
    }

    .th-event-container .thumbnail-container {
        display: flex;
        gap: 10px;
        margin-top: 20px;
        overflow-x: auto;
        padding: 10px 0;
    }

    .th-event-container .thumbnail {
        width: 80px;
        height: 60px;
        border-radius: 6px;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.2s ease;
    }

    .th-event-container .thumbnail.active {
        border-color: var(--th-primary);
    }

    /* Modal Styling */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal-overlay.active {
        display: flex;
        opacity: 1;
    }

    .modal-card {
        position: relative;
        max-width: 90%;
        max-height: 90vh;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        transform: scale(0.8);
        transition: transform 0.3s ease;
    }

    .modal-overlay.active .modal-card {
        transform: scale(1);
    }

    .modal-image {
        max-width: 100%;
        max-height: 80vh;
        display: block;
        object-fit: contain;
        border-radius: 10px;
    }

    .modal-close {
        position: absolute;
        top: -15px;
        right: -15px;
        background: #333;
        color: white;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 20px;
        transition: background 0.2s ease;
    }

    .modal-close:hover {
        background: #555;
    }


    .related-events {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
    }

    .related-events-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 20px;
        color: var(--th-dark-gray);
        display: flex;
        align-items: center;
    }

    .related-events-title i {
        margin-right: 10px;
        color: var(--th-primary);
    }

    .related-events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    .related-event-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        text-decoration: none !important;
        color: inherit !important;
    }

    .related-event-card:hover {
        transform: translateY(-5px);
    }

    .related-event-image {
        width: 100%;
        height: 160px;
        object-fit: cover;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .related-event-content {
        padding: 15px;
    }

    .related-event-name {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--th-dark-gray);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .related-event-meta {
        display: flex;
        flex-direction: column;
        gap: 8px;
        font-size: 14px;
        color: var(--th-text-gray);
    }

    .related-event-meta i {
        width: 16px;
        margin-right: 8px;
        color: var(--th-primary);
    }

    .related-event-description {
        color: #666;
        font-size: 15px;
        margin-bottom: 10px;
        min-height: 38px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    @media (max-width: 768px) {
        .th-event-container .event-top-section {
            flex-direction: column;
        }

        .th-event-container .event-image-container,
        .th-event-container .event-info {
            width: 100%;
        }

        .th-event-container .event-image {
            height: 250px;
        }

        .th-event-container .details-grid {
            grid-template-columns: 1fr;
        }
    }

    .swiper-button-next,
    .swiper-button-prev {
        display: none !important;
    }

    .related-event-card * {
        text-decoration: none !important;
        color: inherit !important;
    }

    .related-events-swiper .swiper-slide:not(:last-child) .related-event-card {
        border-right: 1.5px solid #e0e0e0;
    }

    .related-events-swiper .swiper-slide .related-event-card {
        border-radius: 12px;
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }



    .related-event-card {
        border-radius: 16px;
        overflow: hidden;
        background: white;
    }

    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1.5px solid #e0e0e0;
        overflow: hidden;
        padding: 0;
    }

    .card img {
        width: 100%;
        height: 170px;
        object-fit: cover;
        border-radius: 0;
        display: block;
    }

    .card .info {
        background: #fff;
        border-radius: 0 0 16px 16px;
        box-shadow: none;
        padding: 18px 18px 12px 18px;
        border: none;
        margin-top: 0;
    }

    .card:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.13);
    }
</style>

@endsection

@section('content')
<div class="th-event-container">
    <div class="container">
        <!-- Hiển thị thông báo nếu có -->
        @if (session('success'))
        <div class="alert alert-success"
            style="padding: 10px; margin-bottom: 20px; background-color: rgba(46, 204, 113, 0.15); color: #27ae60; border-radius: 5px;">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-error"
            style="padding: 10px; margin-bottom: 20px; background-color: rgba(231, 76, 60, 0.15); color: #e74c3c; border-radius: 5px;">
            {{ session('error') }}
        </div>
        @endif

        <div class="event-card">
            <div class="event-top-section">
                <!-- Event Image Section (Left) -->
                <div class="event-image-container">
                    @php
                    $images = [];
                    if (!empty($event->images)) {
                    if (is_string($event->images)) {
                    $images = array_filter(explode(';', $event->images));
                    } elseif (is_array($event->images)) {
                    $images = $event->images;
                    }
                    }
                    $firstImage = $images[0] ?? 'images/default-event.jpg';
                    @endphp
                    <img src="{{ asset($firstImage) }}" alt="{{ $event->name }}" class="event-image" id="main-image">

                    <!-- Image Navigation Dots -->
                    @if (!empty($images))
                    <div class="image-navigation">
                        @foreach ($images as $index => $image)
                        <div class="image-nav-dot {{ $index === 0 ? 'active' : '' }}"
                            data-image="{{ asset($image) }}"></div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Event Info Section (Right) -->
                <div class="event-info">
                    <h2 class="event-title">{{ $event->name }}</h2>

                    <div class="event-meta">
                        <div class="meta-item">
                            <i class="fas fa-calendar"></i>
                            <span>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} -
                                {{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') : 'Đang cập nhật' }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $event->location }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-users"></i>
                            <span>Số người tham gia: {{ $event->quantity_now }}/{{ $event->max_quantity }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-tag"></i>
                            <span>
                                <span
                                    class="status-badge {{ $event->status === 'active' ? 'status-active' : 'status-pending' }}">
                                    {{ $event->status === 'active' ? 'Đang hoạt động' : 'Đã kết thúc' }}
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="event-progress">
                        <div class="progress-title">
                            <span>Số lượng tình nguyện viên</span>
                            <span>{{ $event->quantity_now }}/{{ $event->max_quantity }} người</span>
                        </div>
                        <div class="progress-bar">
                            @php
                            $progress =
                            $event->max_quantity > 0
                            ? ($event->quantity_now / $event->max_quantity) * 100
                            : 0;
                            @endphp
                            <div class="progress-fill" style="width: {{ $progress }}%"></div>
                        </div>
                    </div>

                    <div class="action-buttons">
                        @php
                        $userType = session('user_type');
                        $userId = session('user_type') === 'volunteer' ? session('user_id') : null;

                        $user = null;
                        if ($userType === 'volunteer' && $userId) {
                        $user = (object) ['volunteer_id' => $userId, 'avatar' => session('avatar')];
                        } elseif ($userType === 'organization' && session('user_id')) {
                        $user = (object) [
                        'organization_id' => session('user_id'),
                        'avatar' => session('avatar'),
                        ];
                        }

                        $volunteerId = $user && isset($user->volunteer_id) ? $user->volunteer_id : null;
                        $organizationId =
                        $user && isset($user->organization_id) ? $user->organization_id : null;

                        $isOrganization = $organizationId && $event->organization_id === $organizationId;
                        $statusCheck = $event->status === 'active';
                        $approvedCheck = $event->approved !== 'rejected';
                        $quantityCheck = $event->quantity_now < $event->max_quantity;

                            $alreadyRegistered = false;
                            if ($volunteerId) {
                            try {
                            $alreadyRegistered = $event
                            ->volunteers()
                            ->wherePivot('volunteer_id', $volunteerId)
                            ->exists();
                            } catch (\Exception $e) {
                            \Illuminate\Support\Facades\Log::error(
                            'Error checking registration status: ' . $e->getMessage(),
                            );
                            }
                            }

                            $canRegister =
                            $volunteerId &&
                            $statusCheck &&
                            $approvedCheck &&
                            $quantityCheck &&
                            !$alreadyRegistered;
                            @endphp

                            @if ($isOrganization)
                            {{-- <a href="{{ route('events.edit', $event->event_id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Chỉnh sửa
                            </a>
                            <form action="{{ route('event.destroy', $event->event_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                            <a href="{{ route('events.volunteers', $event->event_id) }}" class="btn btn-primary">
                                <i class="fas fa-users"></i> Quản lý tình nguyện viên
                            </a> --}}
                            @else
                            @if ($canRegister)
                            <form action="{{ route('events.register', $event->event_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary"><i
                                        class="fas fa-hand-holding-heart"></i>
                                    Đăng ký tham gia</button>
                            </form>
                            @elseif ($alreadyRegistered && $volunteerId && $statusCheck && $approvedCheck)
                            <form action="{{ route('events.unregister', $event->event_id) }}" method="POST"
                                id="unregister-form-{{ $event->event_id }}">
                                @csrf
                                <button type="submit" class="btn btn-cancel"
                                    data-event-id="{{ $event->event_id }}"><i class="fas fa-times-circle"></i> Hủy
                                    tham gia</button>

                            </form>
                            @else
                            <button class="btn btn-outline" disabled><i class="fas fa-hand-holding-heart"></i> Không
                                thể
                                đăng ký</button>
                            @endif
                            @endif
                            <!-- Nút kết quả -->
                            @if ($hasResult)
                            <a href="{{ route('result.byEvent', $event->event_id) }}" class="btn btn-outline btn-results">
                                <i class="fas fa-chart-bar"></i> Xem kết quả theo sự kiện
                            </a>
                            @else
                            <button class="btn btn-results" disabled>
                                <i class="fas fa-chart-bar"></i> Chưa có kết quả
                            </button>
                            @endif

                    </div>
                </div>
            </div>
            <!-- Thumbnails -->
            <div class="thumbnail-container">
                @foreach ($images as $index => $image)
                <img src="{{ asset($image) }}" class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                    alt="Thumbnail {{ $index + 1 }}">
                @endforeach
            </div>
        </div>

        <!-- Event Description Section -->
        <div class="event-description">
            <h3 class="details-title">
                <i class="fas fa-align-left"></i> Mô tả sự kiện
            </h3>
            <p>{{ $event->description }}</p>
        </div>

        <div class="event-details">
            <h3 class="details-title">
                <i class="fas fa-info-circle"></i> Thông tin chi tiết
            </h3>

            <div class="details-grid">
                <div class="details-item">

                    <div class="details-content" style="display: flex; align-items: center;">
                        <div class="details-icon" style="margin-right: 8px;">
                            <!-- Icon người, có thể dùng font-awesome hoặc SVG -->
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                        <div>
                            <div class="details-label">Người đại diện tổ chức</div>
                            <div class="details-value">{{ $event->organization->representative ?? 'Chưa cập nhật' }}</div>
                        </div>
                    </div>
                </div>

                <div class="details-item">
                    <div class="details-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="details-content">
                        <div class="details-label">Tổ chức</div>
                        <div class="details-value">{{ $event->organization->username ?? 'Không xác định' }}</div>
                    </div>
                </div>

                <div class="details-item">
                    <div class="details-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="details-content">
                        <div class="details-label">Yêu cầu tình nguyện viên</div>
                        <div class="details-value">Tối thiểu: {{ $event->min_quantity }} người | Tối đa:
                            {{ $event->max_quantity }} người
                        </div>
                    </div>
                </div>

                <div class="details-item">
                    <div class="details-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="details-content">
                        <div class="details-label">Ngày tạo</div>
                        <div class="details-value">{{ $event->created_at->format('d/m/Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Events Section -->
        @if (!empty($relatedEvents) && $relatedEvents->isNotEmpty())
        <div class="related-events">
            <h3 class="related-events-title">
                <i class="fas fa-calendar-alt"></i> Các sự kiện khác từ
                {{ $event->organization->username ?? 'Tổ chức này' }}
            </h3>

            <div class="swiper related-events-swiper">
                <div class="swiper-wrapper">
                    @foreach ($relatedEvents as $relatedEvent)
                    <div class="swiper-slide">
                        <div class="card" onclick="goToEvent('{{ $relatedEvent->event_id }}')">
                            @php
                            $relatedImages = [];
                            if (!empty($relatedEvent->images)) {
                            if (is_string($relatedEvent->images)) {
                            $relatedImages = array_filter(explode(';', $relatedEvent->images));
                            } elseif (is_array($relatedEvent->images)) {
                            $relatedImages = $relatedEvent->images;
                            }
                            }
                            $relatedFirstImage = $relatedImages[0] ?? 'images/default-event.jpg';
                            @endphp

                            <img src="{{ asset($relatedFirstImage) }}" alt="{{ $relatedEvent->name }}"
                                class="related-event-image">

                            <div class="related-event-content">
                                <div class="related-event-name"
                                    style="font-size: 18px; font-weight: bold; margin-bottom: 6px;">
                                    {{ $relatedEvent->name }}
                                </div>
                                <div class="related-event-description"
                                    style="color: #666; font-size: 15px; margin-bottom: 10px;">
                                    {{ Str::limit($relatedEvent->description, 100) }}
                                </div>
                                <div class="related-event-meta">
                                    <div>
                                        <b>Thời gian:</b>
                                        {{ \Carbon\Carbon::parse($relatedEvent->start_date)->format('d/m/Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($relatedEvent->end_date)->format('d/m/Y') }}
                                    </div>
                                    <div>
                                        <b>Tham gia:</b>
                                        {{ $relatedEvent->quantity_now }} / {{ $relatedEvent->max_quantity }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Modal hiển thị ảnh lớn -->
<div id="imageModal" class="modal-overlay">
    <div class="modal-card">
        <img id="modalImage" src="" alt="Ảnh lớn" class="modal-image">
        <span class="modal-close" onclick="closeModal()">×</span>
    </div>
</div>
@endsection

@section('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('main-image');
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');

        // Xử lý hình ảnh và thumbnail
        if (mainImage) {
            const dots = document.querySelectorAll('.th-event-container .image-nav-dot');
            const thumbnails = document.querySelectorAll('.th-event-container .thumbnail');

            dots.forEach(dot => {
                dot.addEventListener('click', function() {
                    const imageSrc = this.getAttribute('data-image');
                    if (imageSrc) mainImage.src = imageSrc;
                    dots.forEach(d => d.classList.remove('active'));
                    this.classList.add('active');
                    thumbnails.forEach(t => t.classList.remove('active'));
                    const index = Array.from(dots).indexOf(this);
                    if (thumbnails[index]) thumbnails[index].classList.add('active');
                });
            });

            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    const imageSrc = this.src;
                    if (imageSrc) {
                        mainImage.src = imageSrc;
                        modalImage.src = imageSrc;
                        modal.classList.add('active');
                    }
                    dots.forEach(d => d.classList.remove('active'));
                    const index = Array.from(thumbnails).indexOf(this);
                    if (dots[index]) dots[index].classList.add('active');
                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        }

        // Đóng modal
        function closeModal() {
            modal.classList.remove('active');
        }

        modal.addEventListener('click', e => e.target === modal && closeModal());
        document.addEventListener('keydown', e => e.key === 'Escape' && modal.classList.contains('active') &&
            closeModal());

        // Xử lý hủy tham gia
        document.querySelectorAll('.btn-cancel').forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const form = button.closest('form');
                const eventId = button.getAttribute('data-event-id');
                console.log(eventId);
                Swal.fire({
                    title: 'Bạn có chắc muốn hủy tham gia?',
                    text: 'Hành động này không thể hoàn tác!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Có, hủy tham gia!',
                    cancelButtonText: 'Không',
                }).then(result => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Khởi tạo Swiper cho related events
        if (document.querySelector('.related-events-swiper')) {
            new Swiper('.related-events-swiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1
                    },
                    768: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    }
                }
            });
        }

        // Chuyển hướng đến trang sự kiện liên quan
        window.goToEvent = function(eventId) {
            window.location.href = `/event/${eventId}`;
        };
    });
</script>
@endsection