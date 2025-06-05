{{-- resources/views/organization/dashboard.blade.php --}}
@extends('layouts.master')

@section('title', 'Quản lý tổ chức')

@section('styles')
    <style>
        .tab-header {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 30px;
            margin-bottom: 30px;
            font-size: 20px;
            font-weight: 600;
            color: #555;
        }

        .tab-header a {
            text-decoration: none;
            color: inherit;
            padding-bottom: 5px;
            position: relative;
        }

        .tab-header a.active::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 3px;
            background-color: #3498db;
            border-radius: 2px;
        }

        .dashboard-container {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Chung cho item */
        .item-link {
            text-decoration: none !important;
            color: inherit;
            display: block;
            transition: background 0.3s ease;
        }

        .item-link:hover .item-card {
            background-color: #eef7ff;
        }

        .item-card,
        .noti-card {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 5px solid #3498db;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: background 0.3s ease;
        }


        .event-display {
            display: flex;
            margin-bottom: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #fff;
        }

        .event-display:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .event-display img {
            width: 50%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .event-display:hover img {
            transform: scale(1.03);
        }


        .event-details {
            width: 50%;
            padding: 20px;
        }

        .event-details h4 {
            font-size: 20px;
            font-weight: 700;
        }

        .event-meta-item {
            margin-bottom: 10px;
            font-size: 15px;
        }

        .event-meta-item i {
            margin-right: 6px;
            color: #555;
        }

        .view-event-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 15px;
            padding: 10px 16px;
            background: linear-gradient(135deg, #e74c3c, #e67e22);
            color: white;
            border: none;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .view-event-btn:hover {
            background: linear-gradient(135deg, #d93b2e, #e57b1e);
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }


        .item-card strong,
        .noti-title {
            font-weight: bold;
            color: #2c3e50;
        }

        .noti-card:hover {
            background-color: #eef7ff;
        }

        .noti-title {
            font-size: 18px;
            margin-bottom: 6px;
        }

        .noti-event {
            font-size: 15px;
            color: #007bff;
            margin-bottom: 4px;
        }

        .noti-content {
            font-size: 15px;
            color: #555;
            margin-bottom: 8px;
            white-space: pre-wrap;
        }

        .noti-time {
            font-size: 13px;
            color: #888;
        }

        .btn-send-noti {
            display: inline-block;
            margin-bottom: 15px;
            padding: 10px 16px;
            background-color: #3498db;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }

        .btn-send-noti:hover {
            background-color: #2980b9;
        }
    </style>
@endsection


@section('content')
    <div class="tab-header">
        <a href="{{ route('organization.dashboard', ['tab' => 'events']) }}"
            class="{{ $tab === 'events' ? 'active' : '' }}">Quản lý Sự Kiện</a>
        <a href="{{ route('organization.dashboard', ['tab' => 'eventsPending']) }}"
            class="{{ $tab === 'eventsPending' ? 'active' : '' }}">Quản lý Sự Kiện Chưa Duyệt</a>
        <a href="{{ route('organization.dashboard', ['tab' => 'eventsReject']) }}"
            class="{{ $tab === 'eventsReject' ? 'active' : '' }}">Quản lý Sự Kiện Bị Từ Chối</a>
        <a href="{{ route('organization.dashboard', ['tab' => 'results']) }}"
            class="{{ $tab === 'results' ? 'active' : '' }}">Quản Lý Kết Quả</a>
        <a href="{{ route('organization.dashboard', ['tab' => 'notifications']) }}"
            class="{{ $tab === 'notifications' ? 'active' : '' }}">Quản Lý Thông Báo</a>
    </div>

    <div class="dashboard-container">
        @if ($tab === 'events')
            @forelse($events as $event)
                @php
                    $firstImage = $event->images ? explode(';', $event->images)[0] : 'images/default-event.jpg';
                @endphp
                <a href="{{ route('view.events', $event->event_id) }}" class="item-link">
                    <div class="event-display">
                        <img src="{{ asset(trim($firstImage)) }}" alt="Ảnh sự kiện">
                        <div class="event-details">
                            <h4>{{ $event->name }}</h4>
                            <div class="event-meta-item"><i class="fas fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} -
                                {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</div>
                            <div class="event-meta-item"><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</div>
                            <div class="event-meta-item"><i class="fas fa-users"></i> Số người tham gia:
                                {{ $event->quantity_now }}/{{ $event->max_quantity }}</div>
                            <p><strong>Mô tả:</strong> {{ Str::limit(strip_tags($event->description), 150) }}</p>
                        </div>
                    </div>
                </a>

            @empty
                <p>Chưa có sự kiện nào.</p>
            @endforelse
        @elseif ($tab === 'results')
            @forelse($results as $result)
                <a href="{{ route('view.results', $result->result_id) }}" class="item-link">
                    <div class="event-display">
                        @php
                            $firstImage = $result->images
                                ? explode(';', $result->images)[0]
                                : 'images/default-event.jpg';
                        @endphp
                        <img src="{{ asset(trim($firstImage)) }}" alt="Ảnh kết quả">
                        <div class="event-details">
                            <h4>Kết quả sự kiện: {{ $result->event->name ?? 'Không rõ' }}</h4>
                            <div class="event-meta-item"><i class="fas fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($result->event->start_date)->format('d/m/Y') }} -
                                {{ \Carbon\Carbon::parse($result->event->end_date)->format('d/m/Y') }}</div>
                            <div class="event-meta-item"><i class="fas fa-map-marker-alt"></i>
                                {{ $result->event->location }}</div>
                            <p><strong>Tóm tắt:</strong> {{ Str::limit(strip_tags($result->content), 150) }}</p>
                        </div>
                    </div>
                </a>


            @empty
                <p>Chưa có kết quả nào.</p>
            @endforelse
        @elseif ($tab === 'notifications')
            <h2>📨 Thông báo đã gửi</h2>
            <a href="{{ route('notification.organization.send.event.view') }}" class="btn-send-noti">➕ Gửi thông báo
                mới</a>
            @forelse($notifications as $noti)
                <div class="noti-card">
                    <div class="noti-event">Sự kiện: {{ $noti->event->name ?? 'Không rõ' }}</div>
                    <div class="noti-title">{{ $noti->title }}</div>
                    <div class="noti-content">{{ $noti->content }}</div>
                    <div class="noti-time">Thời gian gửi:
                        {{ \Carbon\Carbon::parse($noti->created_at)->format('d/m/Y H:i') }}</div>
                </div>
            @empty
                <p>Chưa gửi thông báo nào.</p>
            @endforelse
        @elseif ($tab === 'eventsPending')
            @forelse($eventsPending ?? [] as $event)
                <a href="{{ route('view.events', $event->event_id) }}" class="item-link">
                    <div class="event-display">
                        @php
                            $firstImage = $event->images ? explode(';', $event->images)[0] : 'images/default-event.jpg';
                        @endphp
                        <img src="{{ asset(trim($firstImage)) }}" alt="Ảnh sự kiện">
                        <div class="event-details">
                            <h4>{{ $event->name }}</h4>
                            <div class="event-meta-item"><i class="fas fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} -
                                {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</div>
                            <div class="event-meta-item"><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</div>
                            <div class="event-meta-item"><i class="fas fa-users"></i> Số người tham gia:
                                {{ $event->quantity_now }}/{{ $event->max_quantity }}</div>
                            <p><strong>Mô tả:</strong> {{ Str::limit(strip_tags($event->description), 150) }}</p>
                        </div>
                    </div>
                </a>
            @empty
                <p>Chưa có kết quả nào.</p>
            @endforelse
        @elseif ($tab === 'eventsReject')
            @forelse($eventsReject ?? [] as $event)
                <a href="{{ route('view.events', $event->event_id) }}" class="item-link">
                    <div class="event-display">
                        @php
                            $firstImage = $event->images ? explode(';', $event->images)[0] : 'images/default-event.jpg';
                        @endphp
                        <img src="{{ asset(trim($firstImage)) }}" alt="Ảnh sự kiện">
                        <div class="event-details">
                            <h4>{{ $event->name }}</h4>
                            <div class="event-meta-item"><i class="fas fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} -
                                {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</div>
                            <div class="event-meta-item"><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</div>
                            <div class="event-meta-item"><i class="fas fa-users"></i> Số người tham gia:
                                {{ $event->quantity_now }}/{{ $event->max_quantity }}</div>
                            <p><strong>Mô tả:</strong> {{ Str::limit(strip_tags($event->description), 150) }}</p>
                        </div>
                    </div>
                </a>



            @empty
                <p>Chưa có kết quả nào.</p>
            @endforelse
        @endif
    </div>
@endsection
