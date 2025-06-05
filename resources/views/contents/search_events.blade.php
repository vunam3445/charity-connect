@extends('layouts.master')

@section('title', 'Tìm kiếm')

@section('content')
    <style>
        /* Styles cho card tổ chức */
        .org-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            height: 100%;
            transition: transform 0.3s ease;
        }

        .org-card:hover {
            transform: translateY(-5px);
        }

        .org-card-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .org-card-logo {
            width: 60px;
            height: 60px;
            margin-right: 15px;
            border-radius: 50%;
            object-fit: cover;
        }

        .org-card-title {
            flex: 1;
        }

        .org-card-title h2 {
            font-size: 16px;
            margin: 0 0 5px 0;
            font-weight: 600;
            color: #333;
        }

        .org-card-username {
            color: #666;
            font-size: 14px;
        }

        .org-divider {
            height: 1px;
            background-color: #eee;
            margin: 15px 0;
        }

        .org-card-info p {
            margin: 8px 0;
            font-size: 14px;
        }

        .view-details {
            display: inline-block;
            margin-top: 12px;
            color: #ff6600;
            text-decoration: none;
            font-size: 14px;
        }

        .view-details:hover {
            text-decoration: underline;
        }
    </style>

    <div class="container py-4">
        <h2 class="mb-4">Kết quả tìm kiếm</h2>
        @if (request('query'))
            <div class="mb-3">
                <strong>Từ khóa:</strong> "{{ request('query') }}"
            </div>
        @endif

        <ul class="nav nav-tabs mb-3" id="searchTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="event-tab" data-bs-toggle="tab" data-bs-target="#event" type="button"
                    role="tab">Sự kiện</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="org-tab" data-bs-toggle="tab" data-bs-target="#org" type="button"
                    role="tab">Tổ chức</button>
            </li>
        </ul>
        <div class="tab-content" id="searchTabContent">
            <div class="tab-pane fade show active" id="event" role="tabpanel">
                @if (isset($events) && $events->count() > 0)
                    <div class="row">
                        @foreach ($events as $event)
                            <div class="col-md-4 mb-4 d-flex align-items-stretch">
                                <div class="card h-100" style="cursor:pointer;"
                                    onclick="location.href='/event/{{ $event->event_id }}'">
                                    @php
                                        $images = [];
                                        if (!empty($event->images)) {
                                            if (is_string($event->images)) {
                                                $images = array_filter(array_map('trim', explode(';', $event->images)));
                                            } elseif (is_array($event->images)) {
                                                $images = $event->images;
                                            }
                                        }
                                        $firstImage = !empty($images) ? $images[0] : 'images/default-event.jpg';
                                    @endphp
                                    <img src="{{ asset($firstImage) }}" alt="Ảnh chiến dịch" class="card-img-top"
                                        style="height:220px;object-fit:cover;"
                                        onerror="this.src='{{ asset('images/default-event.jpg') }}'">
                                    <div class="card-body d-flex flex-column">
                                        <h2 class="card-title" style="font-size:1.2rem;">{{ $event->name }}</h2>
                                        <p><strong>Địa điểm:</strong> {{ $event->location ?? 'Chưa cập nhật' }}</p>
                                        <p><strong>Đăng ký:</strong> {{ $event->quantity_now ?? 0 }} /
                                            {{ $event->max_quantity ?? 0 }}</p>
                                        <p>
                                            <strong>Thời gian:</strong>
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}
                                            -
                                            {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}
                                        </p>
                                        <a href="/event/{{ $event->event_id }}" class="view-details">Xem chi tiết ›</a>
                                    </div>
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                @elseif(isset($events))
                    <div class="alert alert-warning mt-3">Không tìm thấy sự kiện nào phù hợp.</div>
                @endif
            </div>
            <div class="tab-pane fade" id="org" role="tabpanel">
                @if (isset($organizations) && $organizations->count() > 0)
                    <div class="row">
                        @foreach ($organizations as $org)
                            <div class="col-md-4 mb-4">
                                <div class="org-card" onclick="location.href='/organization/detail/{{ $org->organization_id }}'"
                                    style="cursor:pointer;">
                                    <div class="org-card-header">
                                        <img src="{{ asset('images/' . ($org->avatar ?? 'default-avatar.png')) }}"
                                            alt="Avatar" class="org-card-logo"
                                            onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                                        <div class="org-card-title">
                                            <h2>{{ $org->username }}</h2>
                                            <div class="org-card-username">{{ $org->representative }}</div>
                                        </div>
                                    </div>
                                    <div class="org-divider"></div>
                                    <div class="org-card-info">
                                        <p>Điện thoại: {{ $org->phone }}</p>
                                        <p>Địa chỉ: {{ $org->address }}</p>
                                        <p>Ngày thành lập: {{ \Carbon\Carbon::parse($org->founded_at)->format('d/m/Y') }}
                                        </p>
                                        @if ($org->description)
                                            <p>Mô tả: {{ Str::limit($org->description, 100) }}</p>
                                        @endif
                                        @if ($org->website)
                                            <a href="{{ $org->website }}" class="view-details" target="_blank">Xem chi tiết
                                                ›</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @elseif(isset($organizations))
                    <div class="alert alert-warning mt-3">Không tìm thấy tổ chức nào phù hợp.</div>
                @endif
            </div>
        </div>
    </div>
    <!-- Nếu dùng Bootstrap 5, đảm bảo đã include JS của Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
