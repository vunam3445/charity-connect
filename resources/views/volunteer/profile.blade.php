@extends('layouts.master')

@section('styles')
    <style>
        body {
            background-color: #f0f2f5;
        }

        .cover-section {
            position: relative;
            height: 300px;
            background-size: cover;
            background-position: center;
            border-radius: 0;
            margin-bottom: 15px;
        }

        .profile-container {
            position: relative;
            padding-left: 200px;
            margin-bottom: 20px;
        }

        .volunteer-avatar-container {
            position: absolute;
            bottom: 15px;
            left: 15px;
            z-index: 10;
        }

        .volunteer-avatar {
            width: 170px;
            height: 170px;
            object-fit: cover;
            border: 4px solid #fff;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            top: 41px;
        }

        .volunteer-info {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding-bottom: 10px;
        }

        .nav-tabs .nav-link {
            font-weight: 600;
            padding: 16px 20px;
            border: none;
            border-radius: 0;
            color: #65676b;
        }

        .nav-tabs .nav-link.active {
            color: #ff5722;
            border-bottom: 3px solid #ff5722;
            background-color: transparent;
        }

        .nav-tabs .nav-link:hover:not(.active) {
            background-color: rgba(0, 0, 0, 0.05);
            border-radius: 6px;
        }

        .info-card {
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            background-color: white;
            transition: all 0.3s;
        }

        .activity-card {
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .activity-header {
            display: flex;
            align-items: center;
            padding: 12px;
        }

        .activity-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .activity-meta {
            flex-grow: 1;
        }

        .badge-hours {
            background-color: #ff5722;
            color: white;
            padding: 5px 10px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .section-title {
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            min-width: 100px;
            max-width: 150px;
            height: 3px;
            background-color: #ff5722;
        }

        .fb-btn {
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-weight: 600;
        }

        .fb-btn:hover {
            background-color: #e64a19;
            color: white;
        }

        .fb-btn-outline {
            background-color: #e4e6eb;
            color: #050505;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-weight: 600;
        }

        .fb-btn-outline:hover {
            background-color: #d8dadf;
        }

        .stats-box {
            text-align: center;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .stats-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ff5722;
        }

        .stats-label {
            font-size: 0.9rem;
            color: #65676b;
        }

        .event-images {
            display: flex;
            gap: 12px;
            margin-bottom: 1rem;
            align-items: flex-start;
            flex-wrap: nowrap;
        }

        .event-images .main-img-wrapper {
            flex: 1 1 60%;
            max-width: 60%;
        }

        .event-images .main-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            aspect-ratio: 4/3;
        }

        .event-images .sub-img-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 6px;
            flex: 1 1 40%;
            max-width: 40%;
        }

        .sub-img-grid img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 6px;
        }

        @media (max-width: 768px) {
            .profile-container {
                padding-left: 0;
                text-align: center;
            }

            .volunteer-avatar-container {
                position: relative;
                left: 50%;
                transform: translateX(-50%);
                bottom: auto;
                margin-bottom: 20px;
            }


            .volunteer-info {
                padding-left: 15px;
                padding-right: 15px;
                align-items: center;
            }

            .total-events {
                display: flex;
                justify-content: center !important;
            }

            .container.py-3 {
                padding-top: 0.1rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container py-3">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Cover Section -->
        <div class="mb-3 position-relative">
            <div class="cover-section"
                style="background-image: url('{{ asset('images/' . ($volunteer->cover ?? 'default-cover.jpg')) }}');">
                <div class="top-0 m-3 position-absolute end-0">
                    @if (auth()->guard('volunteer')->check() &&
                            auth()->guard('volunteer')->user()->volunteer_id === $volunteer->volunteer_id)
                        <form action="/volunteer/{{ $volunteer->volunteer_id }}/upload-cover" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="cover_image" onchange="this.form.submit()" hidden id="coverInput">
                            <button type="button" class="btn btn-light"
                                onclick="document.getElementById('coverInput').click()">
                                <i class="fas fa-camera me-1"></i> Thêm ảnh bìa
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="container">
                <div class="profile-container">
                    <div class="volunteer-avatar-container">
                        <img src="{{ asset('images/' . ($volunteer->avatar ?? 'default-avatar.png')) }}"
                            alt="{{ $volunteer->fullname }}" class="volunteer-avatar">
                        @if (auth()->guard('volunteer')->check() &&
                                auth()->guard('volunteer')->user()->volunteer_id === $volunteer->volunteer_id)

                            <form action="/volunteer/{{ $volunteer->volunteer_id }}/upload-avatar" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="avatar_image" onchange="this.form.submit()" hidden
                                    id="avatarInput">
                                <button type="button" class="p-2 btn btn-light rounded-circle"
                                    onclick="document.getElementById('avatarInput').click()">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </form>
                            @endif
                    </div>

                    <div class="volunteer-info">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end">
                            <div>
                                <div class="mb-1 d-flex align-items-center">
                                    <h1 class="mb-0 fw-bold">{{ $volunteer->fullname }}</h1>
                                </div>
                                <p class="mb-1 text-muted">
                                    <i class="fas fa-user me-2"></i>
                                    Username: <strong>{{ $volunteer->username }}</strong>
                                </p>
                                <p class="mb-2 text-muted">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    Tham gia:
                                    <strong>{{ \Carbon\Carbon::parse($volunteer->created_at)->translatedFormat('d \\t\\há\\n\\g m, Y') }}</strong>
                                </p>
                            </div>
                            <button class="btn fb-btn" data-bs-toggle="modal" data-bs-target="#followedModal">
                                <i class="fas fa-plus-circle me iniquity-1"></i> Đang theo dõi
                            </button>

                            <div class="modal fade" id="followedModal" tabindex="-1" aria-labelledby="followedModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="followedModalLabel">Danh sách tổ chức đã theo dõi
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Đóng"></button>
                                        </div>
                                        <div class="modal-body" id="followed-org-list">
                                            <p>Đang tải dữ liệu...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <ul class="mb-4 nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#" id="tab-su-kien-dang-ky">Sự kiện đang đăng ký</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="tab-su-kien-tham-gia">Sự kiện đã tham gia</a>
            </li>
        </ul>

        <!-- Nội dung chi tiết -->
        <div class="row">
            <!-- Cột bên trái -->
            <div class="col-md-5 col-lg-4">
                <div class="mb-4">
                    <div class="card info-card">
                        <div class="bg-white card-header">
                            <h5 class="mb-0 section-title">Tổng quan</h5>
                        </div>
                        <div class="card-body">
                            <div class="total-events">
                                <div class="stats-box">
                                    <div class="stats-number">{{ $volunteer->events->count() }}</div>
                                    <div class="stats-label">Sự kiện tham gia</div>
                                </div>
                            </div>
                            <div class="text-center">
                                @php
                                    $point = $volunteer->point;
                                    $level = match (true) {
                                        $point < 1000 => 'Tình nguyện viên Đồng',
                                        $point <= 2000 => 'Tình nguyện viên Bạc',
                                        default => 'Tình nguyện viên Vàng',
                                    };
                                @endphp
                                <span class="badge-hours">Cấp độ: {{ $level }} ({{ $point }} điểm)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="card info-card">
                        <div class="bg-white card-header">
                            <h5 class="mb-0 section-title">Thông tin liên hệ</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="px-0 border-0 list-group-item d-flex align-items-center">
                                    <div class="flex-shrink-0 p-2 rounded bg-light">
                                        <i class="fas fa-envelope text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0">{{ $volunteer->email }}</p>
                                    </div>
                                </li>
                                <li class="px-0 border-0 list-group-item d-flex align-items-center">
                                    <div class="flex-shrink-0 p-2 rounded bg-light">
                                        <i class="fas fa-phone text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0">{{ $volunteer->phone }}</p>
                                    </div>
                                </li>
                                <li class="px-0 border-0 list-group-item d-flex align-items-center">
                                    <div class="flex-shrink-0 p-2 rounded bg-light">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0">{{ $volunteer->address }}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cột bên phải -->
            <div class="col-md-7 col-lg-8">
                <!-- Tab Sự kiện -->


                <!-- Tab Sự kiện đã đăng ký -->
                <div id="content-su-kien-dang-ky" class="tab-content" style="display:none;">
                    <div id="registered-events-container">
                        <p>Đang tải sự kiện đã đăng ký...</p>
                    </div>
                </div>

                <!-- Tab Sự kiện đã tham gia -->
                <div id="content-su-kien-tham-gia" class="tab-content" style="display:none;">
                    @forelse($volunteer->events as $event)
                        @php
                            $images = array_filter(explode(';', $event->image ?? ''));
                            $avatar = $event->organization->avatar ?? 'default-avatar.png';
                            $orgName = $event->organization->username ?? 'Tổ chức';
                        @endphp
                        <div class="card activity-card">
                            <div class="activity-header">
                                <img src="{{ asset('images/' . $avatar) }}" class="activity-avatar"
                                    alt="Avatar tổ chức">
                                <div class="activity-meta">
                                    <h6 class="mb-0">{{ $orgName }}</h6>
                                    <small
                                        class="text-muted">{{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d \\t\\há\\n\\g m, Y') }}</small>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <h5 class="card-title">{{ $event->name }}</h5>
                                <p><strong>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} -
                                        {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</strong> |
                                    {{ $event->location }}</p>
                                <p>{{ $event->description }}</p>
                                @if (count($images) > 0)
                                    <div class="event-images">
                                        <div class="main-img-wrapper">
                                            <img src="{{ asset($images[0]) }}" alt="Ảnh chính">
                                        </div>
                                        @if (count($images) > 1)
                                            <div class="sub-img-grid">
                                                @foreach (array_slice($images, 1, 4) as $img)
                                                    <img src="{{ asset($img) }}" alt="Ảnh phụ">
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                <div class="gap-2 d-flex">
                                    <a href="{{ route('event.show', $event->event_id) }}" class="fb-btn">
                                        <i class="fas fa-eye me-1"></i> Xem chi tiết
                                    </a>
                                    <button class="fb-btn-outline"><i class="fas fa-share me-1"></i> Chia sẻ</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Không có sự kiện đã tham gia nào.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        #followed-org-list .org-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 10px 15px;
            border-bottom: 1px solid #e9ecef;
            justify-content: space-between;
        }

        #followed-org-list .org-item:last-child {
            border-bottom: none;
        }

        #followed-org-list .avatar {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #007bff;
            flex-shrink: 0;
        }

        #followed-org-list .org-info {
            flex-grow: 1;
        }

        #followed-org-list .org-name {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 2px;
        }

        #followed-org-list .org-representative {
            font-size: 0.9rem;
            color: #6c757d;
            margin: 0;
        }

        #followed-org-list .btn-view {
            min-width: 70px;
            white-space: nowrap;
            background-color: #ff5722;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('followedModal');
            const modalBody = document.getElementById('followed-org-list');

            modal.addEventListener('show.bs.modal', function() {
                modalBody.innerHTML = '<p>Đang tải dữ liệu...</p>';
                const volunteerId = '{{ $volunteer->volunteer_id }}';

                fetch(`/volunteer/${volunteerId}/followed`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Lỗi khi lấy dữ liệu');
                        return response.json();
                    })
                    .then(data => {
                        if (!data.organizations || data.organizations.length === 0) {
                            modalBody.innerHTML = '<p>Bạn chưa theo dõi tổ chức nào.</p>';
                            return;
                        }

                        const baseUrl = window.location.origin;
                        let html = '';
                        data.organizations.forEach(org => {
                            const avatarFile = org.avatar || 'default-avatar.png';
                            const avatarPath = `${baseUrl}/images/${avatarFile}`;
                            html += `
                            <div class="org-item">
                                <img src="${avatarPath}" alt="Avatar" class="avatar" />
                                <div class="org-info">
                                    <div class="org-name">${org.username}</div>
                                    <div class="org-representative">${org.representative}</div>
                                </div>
                                <a href="/organization/${org.organization_id}" class="btn btn-sm btn-view">Xem</a>
                            </div>
                        `;
                        });
                        modalBody.innerHTML = html;
                    })
                    .catch(error => {
                        modalBody.innerHTML = '<p style="color: red;">Không thể tải danh sách.</p>';
                        console.error('Lỗi:', error);
                    });
            });

            // Tab switching
            const tabs = {

                'tab-su-kien-dang-ky': 'content-su-kien-dang-ky',
                'tab-su-kien-tham-gia': 'content-su-kien-tham-gia'
            };

            Object.keys(tabs).forEach(tabId => {
                document.getElementById(tabId).addEventListener('click', function(event) {
                    event.preventDefault();

                    // Xóa trạng thái active của tất cả các tab
                    document.querySelectorAll('.nav-tabs .nav-link').forEach(link => link.classList
                        .remove('active'));
                    this.classList.add('active');

                    // Ẩn tất cả nội dung tab
                    document.querySelectorAll('.tab-content').forEach(content => content.style
                        .display = 'none');

                    // Hiển thị nội dung tương ứng
                    const contentId = tabs[tabId];
                    document.getElementById(contentId).style.display = 'block';


                    // Nếu là tab "Sự kiện đã đăng ký", gọi AJAX
                    if (tabId === 'tab-su-kien-dang-ky') {
                        const volunteerId = '{{ $volunteer->volunteer_id }}';
                        const container = document.getElementById('registered-events-container');
                        container.innerHTML = '<p>Đang tải sự kiện đã đăng ký...</p>';

                        fetch(`/volunteer/events/registered/${volunteerId}`, {
                                headers: {
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    console.error('Response status:', response.status);
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.error) {
                                    container.innerHTML =
                                        `<p style="color: red;">${data.error}</p>`;
                                    return;
                                }

                                // Handle both old and new response formats
                                const events = data.data || data.events || [];

                                if (events && events.length > 0) {
                                    let html = '';
                                    events.forEach(event => {
                                        const images = event.image ? event.image.split(
                                            ';').filter(img => img) : [];
                                        const avatar = event.organization?.avatar ??
                                            'default-avatar.png';
                                        const orgName = event.organization?.username ??
                                            'Tổ chức';

                                        html += `
                                        <div class="card activity-card">
                                            <div class="activity-header">
                                                <img src="{{ asset('images/' . $avatar) }}" class="activity-avatar" alt="Avatar tổ chức">
                                                <div class="activity-meta">
                                                    <h6 class="mb-0">${orgName}</h6>
                                                    <small class="text-muted">${new Date(event.start_date).toLocaleDateString('vi-VN', { day: 'numeric', month: 'long', year: 'numeric' })}</small>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <h5 class="card-title">${event.name}</h5>
                                                <p><strong>${new Date(event.start_date).toLocaleDateString('vi-VN')} - ${new Date(event.end_date).toLocaleDateString('vi-VN')}</strong> | ${event.location}</p>
                                                <p>${event.description}</p>
                                                ${images.length > 0 ? `
                                                        <div class="event-images">
                                                            <div class="main-img-wrapper">
                                                                <img src="{{ asset('') }}${images[0]}" alt="Ảnh chính">
                                                            </div>
                                                            ${images.length > 1 ? `
                                                            <div class="sub-img-grid">
                                                                ${images.slice(1, 5).map(img => `<img src="{{ asset('') }}${img}" alt="Ảnh phụ">`).join('')}
                                                            </div>
                                                        ` : ''}
                                                        </div>
                                                    ` : ''}
                                                <div class="gap-2 d-flex">
                                                    <a href="/event/${event.event_id}" class="fb-btn">
                                                        <i class="fas fa-eye me-1"></i> Xem chi tiết
                                                    </a>
                            
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                    });
                                    container.innerHTML = html;
                                } else {
                                    container.innerHTML =
                                        '<p>Không có sự kiện đã đăng ký nào.</p>';
                                }
                            })
                            .catch(error => {
                                console.error('Lỗi chi tiết:', error);
                                container.innerHTML =
                                    '<p style="color: red;">Không thể tải danh sách sự kiện.</p>';
                            });
                    }
                });
            });
            document.getElementById('tab-su-kien-dang-ky').click();
        });
    </script>
@endsection
