@extends('layouts.master')

@section('title', 'Chi tiết Chiến dịch')

@section('styles')
    <style>
        :root {
            --primarys: #e67e22;
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

        .event-header {
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

        .event-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .event-top-section {
            display: flex;
            flex-direction: row;
        }

        .event-image-container {
            width: 50%;
            position: relative;
            overflow: hidden;
        }

        .event-image {
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

        .event-info {
            width: 50%;
            padding: 20px;
        }

        .event-title {
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

        .event-meta {
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
            color: var(--primarys);
            width: 20px;
            text-align: center;
        }

        .event-progress {
            margin-bottom: 25px;
        }

        .progress-title {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .event-progress .progress-bar-wrapper {
            background-color: #e9ecef;
            height: 20px;
            border-radius: 10px;
            overflow: hidden;
        }

        .event-progress .progress-fill {
            background-color: #ff5722;
            height: 100%;
            transition: width 0.5s ease-in-out;
        }

        .admin-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
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
            background-color: var(--danger);
            color: white;
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

        .event-description {
            padding: 20px;
            line-height: 1.7;
            color: var(--text-gray);
            text-align: justify;
        }

        .event-details {
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

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .details-item {
            display: flex;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .details-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(63, 81, 181, 0.1);
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .details-content {
            flex-grow: 1;
        }

        .details-label {
            font-size: 14px;
            color: var(--text-gray);
            margin-bottom: 5px;
        }

        .details-value {
            font-weight: 600;
            color: var(--dark-gray);
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .status-active {
            background-color: rgba(76, 175, 80, 0.15);
            color: #4caf50;
        }

        .status-pending {
            background-color: rgba(255, 152, 0, 0.15);
            color: #ff9800;
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

        .statistics-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .stat-item {
            background-color: rgba(63, 81, 181, 0.05);
            border-radius: 8px;
            padding: 15px;
            margin-left: 15px;
            margin-right: 15px;

            /* Thêm dòng sau để căn giữa text */
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* căn giữa theo chiều dọc */
            align-items: center;
            /* căn giữa theo chiều ngang */
            text-align: center;
            /* căn giữa text trong các phần tử con */
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-gray);
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary);
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
            z-index: 1000;
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
            margin: 50px auto;
        }

        .modal {
            overflow-y: auto;
            padding: 20px 0;
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

        /* Volunteer list table */
        .volunteer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .volunteer-table th,
        .volunteer-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .volunteer-table th {
            background-color: rgba(63, 81, 181, 0.05);
            font-weight: 600;
        }

        .volunteer-table tr:hover {
            background-color: rgba(63, 81, 181, 0.03);
        }

        .action-icon {
            color: var(--primary);
            cursor: pointer;
            margin-right: 10px;
        }

        .qr-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .qr-code {
            width: 250px;
            height: 250px;
            margin-bottom: 20px;
        }

        .qr-info {
            text-align: center;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .event-top-section {
                flex-direction: column;
            }

            .event-image-container,
            .event-info {
                width: 100%;
            }

            .event-image {
                height: 250px;
            }

            .details-grid,
            .stats-grid,
            .admin-buttons {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="event-header">
            <button class="back-button" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i> Quay lại
            </button>
            <h1 class="page-title">Quản lý chi tiết sự kiện <span class="admin-badge">Quản trị viên</span></h1>
        </div>

        <!-- Statistics Section -->
        <div class="statistics-card">
            <h3 class="details-title">
                <i class="fas fa-chart-line"></i> Thống kê chiến dịch
            </h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-label">Tổng đăng ký</div>
                    <div class="stat-value">{{ $event->volunteers->count() }}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Đã phê duyệt</div>
                    <div class="stat-value">{{ $event->volunteers->where('status', 'approved')->count() }}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Đã điểm danh</div>
                    <div class="stat-value">{{ $event->volunteers->where('attended', true)->count() }}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Chờ phê duyệt</div>
                    <div class="stat-value">{{ $event->volunteers->where('status', 'pending')->count() }}</div>
                </div>
            </div>
        </div>

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

                    <!-- Thumbnails for multiple images -->
                    <div class="thumbnail-container">
                        @foreach ($images as $index => $image)
                            <img src="{{ asset($image) }}" class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                                alt="Thumbnail {{ $index + 1 }}">
                        @endforeach
                    </div>
                </div>

                <!-- Event Info Section (Right) -->
                <div class="event-info">
                    <h2 class="event-title">
                        {{ $event->name }}
                        <button class="edit-btn" id="editEventBtn"><i class="fas fa-edit"></i></button>
                    </h2>

                    <div class="event-meta">
                        <div class="meta-item">
                            <i class="fas fa-calendar"></i>
                            <span>Ngày bắt đầu: {{ $event->start_date }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-calendar"></i>
                            <span>Ngày kết thúc: {{ $event->end_date }}</span>
                            <span>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} -
                                {{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') : 'Đang cập nhật' }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $event->location }}</span>
                            <span>{{ $event->location }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-users"></i>
                            <span>Số lượng tình nguyện viên</span>
                            <span>{{ $event->quantity_now }}/{{ $event->max_quantity }} người</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-tag"></i>
                            <span><span
                                    class="status-badge {{ $event->status === 'active' ? 'status-active' : 'status-pending' }}">
                                    {{ $event->status === 'active' ? 'Đang hoạt động' : 'Đã kết thúc' }}
                                </span></span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-check-circle"></i>
                            <span><span
                                    class="status-badge {{ $event->approved === 'approved' ? 'status-active' : 'status-pending' }}">
                                    {{ $event->approved === 'approved' ? 'Đã phê duyệt' : 'Đang chờ phê duyệt' }}
                                </span></span>
                        </div>
                    </div>

                    <div class="event-progress">
                        <div class="progress-title d-flex justify-content-between mb-1">
                            <span>Số lượng tình nguyện viên</span>
                            <span>{{ $event->quantity_now }}/{{ $event->max_quantity }} người</span>
                        </div>

                        <div class="progress-bar-wrapper"
                            style="background-color: #e9ecef; height: 20px; border-radius: 10px; overflow: hidden;">
                            @php
                                $progress =
                                    $event->max_quantity > 0 ? ($event->quantity_now / $event->max_quantity) * 100 : 0;
                            @endphp

                            <div class="progress-fill"
                                style="
                                width: {{ $progress }}%;
                                height: 100%;
                                background-color: #ff5722;
                                transition: width 0.5s ease-in-out;
                            ">
                            </div>
                        </div>
                    </div>

                    <!-- Admin Control Buttons -->
                    <div class="admin-buttons">
                        <button class="btn btn-primary" id="viewVolunteersBtn">
                            <i class="fas fa-users"></i> Danh sách TNV
                        </button>
                        <button class="btn btn-success" id="createQRBtn">
                            <i class="fas fa-qrcode"></i> Tạo mã QR điểm danh
                        </button>
                        @if ($event->status === 'completed')
                            @if ($event->results && $event->results->count() > 0)
                                <button class="btn btn-primary" id="viewResultBtn"
                                    onclick="window.location.href='{{ route('result.show', $event->results->result_id) }}'">
                                    <i class="fas fa-chart-bar"></i> Xem kết quả
                                </button>
                            @else
                                <button class="btn btn-primary" id="createResultBtn">
                                    <i class="fas fa-chart-bar"></i> Tạo kết quả
                                </button>
                            @endif
                        @else
                            <button class="btn btn-secondary" id="completeEventBtn">
                                <i class="fas fa-check-circle"></i> Kết thúc sự kiện
                            </button>
                        @endif
                        <button class="btn btn-warning" id="sendNotificationBtn">
                            <i class="fas fa-bell"></i> Gửi thông báo
                        </button>
                    </div>
                </div>
            </div>

            <!-- Event Description Section (Below) -->
            <div class="event-description">
                <h3 class="details-title">
                    <i class="fas fa-align-left"></i> Mô tả sự kiện
                </h3>
                <p>{{ $event->description }}</p>
                <br>
            </div>
        </div>

        <div class="event-details">
            <h3 class="details-title">
                <i class="fas fa-info-circle"></i> Thông tin chi tiết
            </h3>

            <div class="details-grid">
                <div class="details-item">
                    <div class="details-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="details-content">
                        <div class="details-label">Sự Kiện</div>
                        <div class="details-value">{{ $event->name }}</div>
                    </div>
                </div>

                <div class="details-item">
                    <div class="details-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="details-content">
                        <div class="details-label">Địa điểm</div>
                        <div class="details-value">{{ $event->location }}</div>
                    </div>
                </div>

                <div class="details-item">
                    <div class="details-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="details-content">
                        <div class="details-label">Yêu cầu tình nguyện viên</div>
                        <div class="details-value">Tối thiểu: {{ $event->min_quantity }} người | Tối đa:
                            {{ $event->max_quantity }} người</div>
                    </div>
                </div>

                <div class="details-item">
                    <div class="details-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="details-content">
                        <div class="details-label">Ngày tạo</div>
                        <div class="details-value">{{ $event->created_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Event Modal -->
    <!-- Edit Event Modal -->
    <div class="modal" id="editEventModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fas fa-edit"></i> Chỉnh sửa thông tin chiến dịch</h3>
                <button class="modal-close" data-dismiss="modal">×</button>
            </div>

            <div class="modal-body">
                <form id="editEventForm" action="{{ route('events.update', $event->event_id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Thêm trường ẩn cho organization_id -->
                    <input type="hidden" name="organization_id" value="{{ $event->organization_id }}">

                    <div class="form-group">
                        <label class="form-label" for="eventTitle">Tên chiến dịch</label>
                        <input type="text" name="name" class="form-control" id="eventTitle"
                            value="{{ $event->name }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="eventStartDate">Ngày bắt đầu</label>
                        <input type="date" name="start_date" class="form-control" id="eventStartDate"
                            value="{{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="eventEndDate">Ngày kết thúc</label>
                        <input type="date" name="end_date" class="form-control" id="eventEndDate"
                            value="{{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('Y-m-d') : '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="eventLocation">Địa điểm</label>
                        <input type="text" name="location" class="form-control" id="eventLocation"
                            value="{{ $event->location }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="eventMaxVolunteers">Số lượng tình nguyện viên tối đa</label>
                        <input type="number" name="max_quantity" class="form-control" id="eventMaxVolunteers"
                            value="{{ $event->max_quantity }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="eventMinVolunteers">Số lượng tình nguyện viên tối thiểu</label>
                        <input type="number" name="min_quantity" class="form-control" id="eventMinVolunteers"
                            value="{{ $event->min_quantity }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="eventDescription">Mô tả sự kiện</label>
                        <textarea name="description" class="form-control" id="eventDescription" required>{{ $event->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Hình ảnh</label>
                        <input type="file" name="images[]" class="form-control" multiple>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-outline" data-dismiss="modal">Hủy</button>
                <button class="btn btn-primary" id="saveEventBtn">Lưu thay đổi</button>
            </div>
        </div>
    </div>


    <!-- View Volunteers Modal -->
    <div class="modal" id="viewVolunteersModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fas fa-users"></i> Danh sách tình nguyện viên</h3>
                <button class="modal-close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <table class="volunteer-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>SĐT</th>
                            <th>Điểm</th>
                            <th>Ngày đăng ký</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event->volunteers as $index => $volunteer)
                            <tr onclick="window.location.href='{{ url('volunteer/' . $volunteer->volunteer_id) }}'"
                                style="cursor: pointer;">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $volunteer->username }}</td>
                                <td>{{ $volunteer->email }}</td>
                                <td>{{ $volunteer->phone }}</td>
                                <td>{{ $volunteer->point }}</td>
                                <td>{{ \Carbon\Carbon::parse($volunteer->pivot->created_at)->format('d/m/Y') }}</td>
                                <td>
                                    <form method="POST"
                                        action="{{ route('volunteer.remove', ['event_id' => $event->event_id, 'volunteer_id' => $volunteer->volunteer_id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm btn-remove-volunteer"
                                            style="opacity: 1; visibility: visible; color: white; background-color: #dc3545;"
                                            data-event-id="{{ $event->event_id }}"
                                            data-volunteer-id="{{ $volunteer->volunteer_id }}"
                                            onclick="event.stopPropagation();">
                                            Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.btn-remove-volunteer').click(function(e) {
                    e.stopPropagation();

                    if (!confirm('Bạn có chắc muốn xóa tình nguyện viên này khỏi sự kiện?')) {
                        return;
                    }

                    var eventId = $(this).data('event-id');
                    var volunteerId = $(this).data('volunteer-id');
                    var $button = $(this);

                    $.ajax({
                        url: '/events/' + eventId + '/volunteers/' + volunteerId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                $button.closest('tr').remove();
                            } else {
                                alert('Xóa thất bại, vui lòng thử lại.');
                            }
                        },
                        error: function() {
                            alert('Lỗi server, vui lòng thử lại sau.');
                        }
                    });
                });
            });
        </script>
    </div>


    <!-- Create Result Modal -->
    @if ($event->approved === 'approved')
        <div class="modal" id="createResultModal">
            <div class="modal-content">
                <div class="modal-header" style="background: #ff5722; color: white;">
                    <h3 class="modal-title" style="color: white;">
                        <i class="fas fa-plus-circle" style="margin-right: 10px; "></i>
                        Tạo kết quả cho sự kiện: {{ $event->name }}
                    </h3>
                    <button class="modal-close" data-dismiss="modal" style="color: white;">×</button>
                </div>
                <div class="modal-body">
                    <form id="createResultForm" action="{{ route('result.store') }}" method="POST"
                        enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                        <div class="form-group mb-4">
                            <label for="content" class="form-label fw-bold">
                                <i class="fas fa-align-left" style="margin-right: 10px;"></i>Nội dung
                            </label>
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="5"
                                required placeholder="Nhập nội dung kết quả...">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="images" class="form-label fw-bold">
                                <i class="fas fa-images" style="margin-right: 10px;"></i>Hình ảnh
                            </label>
                            <div class="input-group">
                                <input type="file" name="images[]" id="images"
                                    class="form-control @error('images.*') is-invalid @enderror" multiple
                                    accept="image/jpeg,image/png,image/jpg,image/gif" required>
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-arrow-left" style="margin-right: 10px;"></i>Hủy
                    </button>
                    <button class="btn btn-primary" id="saveResultBtn"
                        style="background: #ff5722; border-color: #ff5722;">
                        <i class="fas fa-save" style="margin-right: 10px;"></i>Tạo kết quả
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- QR Code Modal -->
    <div class="modal" id="qrCodeModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fas fa-qrcode"></i> Mã QR điểm danh</h3>
                <button class="modal-close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <div class="qr-container">
                    <img id="qrCodeImage" src="" alt="QR Code" class="qr-code">
                    <div class="qr-info">
                        Quét mã QR này để điểm danh cho sự kiện "{{ $event->name }}".
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" data-dismiss="modal">Đóng</button>
                <button id="downloadQRBtn" class="btn btn-primary">Tải mã QR</button>
            </div>
        </div>
    </div>

    <!-- Send Notification Modal -->
    <div class="modal" id="sendNotificationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fas fa-bell"></i> Gửi thông báo</h3>
                <button class="modal-close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <form id="sendNotificationForm">
                    <div class="form-group">
                        <label class="form-label" for="notificationTitle">Tiêu đề thông báo</label>
                        <input type="text" class="form-control" id="notificationTitle"
                            placeholder="Nhập tiêu đề thông báo">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="notificationContent">Nội dung thông báo</label>
                        <textarea class="form-control" id="notificationContent" placeholder="Nhập nội dung thông báo đến tình nguyện viên"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" data-dismiss="modal">Hủy</button>
                <button class="btn btn-primary" id="sendNotificationConfirmBtn">Gửi thông báo</button>
            </div>
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

            // Handle Complete Event button
            const completeEventBtn = document.getElementById('completeEventBtn');
            if (completeEventBtn) {
                completeEventBtn.addEventListener('click', function() {
                    if (confirm('Bạn có chắc muốn kết thúc sự kiện này?')) {
                        const eventId = '{{ $event->event_id }}';
                        fetch(`/events/${eventId}/complete`, {
                                method: 'GET',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Tải lại trang để cập nhật trạng thái
                                    window.location.reload();
                                } else {
                                    alert(data.message || 'Có lỗi xảy ra khi kết thúc sự kiện!');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Có lỗi xảy ra khi kết thúc sự kiện!');
                            });
                    }
                });
            }

            // Handle Create Result button
            const createResultBtn = document.getElementById('createResultBtn');
            if (createResultBtn) {
                createResultBtn.addEventListener('click', function() {
                    openModal('createResultModal');
                });
            }

            // Handle other buttons
            const viewVolunteersBtn = document.getElementById('viewVolunteersBtn');
            if (viewVolunteersBtn) {
                viewVolunteersBtn.addEventListener('click', function() {
                    openModal('viewVolunteersModal');
                });
            }

            const createQRBtn = document.getElementById('createQRBtn');
            if (createQRBtn) {
                createQRBtn.addEventListener('click', function() {
                    openModal('qrCodeModal');
                    generateQRCode();
                });
            }

            const sendNotificationBtn = document.getElementById('sendNotificationBtn');
            if (sendNotificationBtn) {
                sendNotificationBtn.addEventListener('click', function() {
                    openModal('sendNotificationModal');
                });
            }

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
            const cancelButtons = document.querySelectorAll('.modal-footer .btn-outline');
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

            // Handle QR Code generation
            function generateQRCode() {
                const eventId = '{{ $event->event_id }}';
                const volunteerId = '{{ auth()->user()->volunteer_id ?? '' }}';

                axios.post('/organizations/events/qrcode', {
                        event_id: eventId,
                        volunteer_id: volunteerId
                    }, {
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(function(response) {
                        const qrUrl = response.data.qrcode;
                        const qrImage = document.getElementById('qrCodeImage');
                        if (qrImage) {
                            qrImage.src = qrUrl;
                        }
                    })
                    .catch(function(error) {
                        console.error('Lỗi tạo mã QR:', error);
                        alert('Tạo mã QR thất bại');
                    });
            }

            // Handle download QR button
            const downloadQRBtn = document.getElementById('downloadQRBtn');
            if (downloadQRBtn) {
                downloadQRBtn.addEventListener('click', function() {
                    const qrImage = document.getElementById('qrCodeImage');
                    if (!qrImage || !qrImage.src) {
                        alert('Chưa có mã QR để tải!');
                        return;
                    }

                    const link = document.createElement('a');
                    link.href = qrImage.src;
                    link.download = 'qrcode_{{ $event->event_id }}.png';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                });
            }

            // Handle Save Result button - Replace the existing saveResultBtn event listener
            const saveResultBtn = document.getElementById('saveResultBtn');
            if (saveResultBtn) {
                saveResultBtn.addEventListener('click', function() {
                    const form = document.getElementById('createResultForm');
                    if (form) {
                        // Thêm để kiểm tra form trước khi submit
                        console.log("Form being submitted:", form);
                        console.log("Form action:", form.action);
                        console.log("Form method:", form.method);

                        // Thực hiện submit form
                        form.submit();
                    } else {
                        console.error("Form with ID 'createResultForm' not found!");
                    }
                });
            }

            // Image preview functionality
            const imageInput = document.getElementById('images');
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
            const handleSendEventNotification = () => {
                const sendNotificationConfirmBtn = document.getElementById('sendNotificationConfirmBtn');
                if (sendNotificationConfirmBtn) {
                    sendNotificationConfirmBtn.addEventListener('click', function() {
                        console.log("Gửi thông báo button clicked");
                        const eventId = '{{ $event->event_id }}';
                        const title = document.getElementById('notificationTitle').value.trim();
                        const content = document.getElementById('notificationContent').value.trim();

                        if (!title || !content) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Thiếu thông tin',
                                text: 'Vui lòng nhập tiêu đề và nội dung thông báo.',
                                confirmButtonText: 'OK',
                                customClass: {
                                    confirmButton: 'btn btn-warning'
                                },
                                buttonsStyling: false
                            });
                            return;
                        }

                        sendNotificationConfirmBtn.disabled = true;

                        axios.post('/organization/notifications/send', {
                                event_id: eventId,
                                title: title,
                                content: content
                            })
                            .then(response => {
                                Swal.fire({
                                    icon: 'success',
                                    title: '🎉 Gửi thông báo thành công!',
                                    text: 'Thông báo đã được gửi đến tình nguyện viên của sự kiện.',
                                    confirmButtonText: 'Đóng',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                });

                                document.getElementById('notificationTitle').value = '';
                                document.getElementById('notificationContent').value = '';
                                document.getElementById('sendNotificationModal').style.display =
                                    'none';
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi!',
                                    text: 'Không gửi được thông báo. Vui lòng thử lại.',
                                    confirmButtonText: 'Thử lại',
                                    customClass: {
                                        confirmButton: 'btn btn-danger'
                                    },
                                    buttonsStyling: false
                                });
                                console.error('Lỗi gửi thông báo:', error);
                            })
                            .finally(() => {
                                sendNotificationConfirmBtn.disabled = false;
                            });
                    });
                }
            };
            handleSendEventNotification();
        });
    </script>
@endsection
