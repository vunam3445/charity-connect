@extends('admin.admin')

@section('content')
<style>
    .noti-section {
        margin-bottom: 50px;
    }

    .noti-section h4 {
        font-size: 20px;
        font-weight: bold;
        color: #2c3e50;
        border-left: 5px solid #3498db;
        padding-left: 10px;
        margin-bottom: 15px;
    }

    ul.noti-list {
        list-style: none;
        padding: 0;
    }

    .noti-item {
        background: #f9f9f9;
        margin-bottom: 15px;
        border-radius: 8px;
        padding: 15px 20px;
        border-left: 4px solid #3498db;
        transition: background 0.3s ease;
    }

    .noti-item:hover {
        background: #eef7ff;
    }

    .noti-item strong {
        font-size: 16px;
        color: #34495e;
    }

    .noti-meta {
        font-size: 13px;
        color: #888;
        margin-top: 5px;
    }

    .noti-content {
        margin-top: 5px;
        color: #555;
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            {{-- 1. Toàn hệ thống --}}
            <div class="noti-section">
                <h4>📢 Thông báo toàn hệ thống (Tình nguyện viên)</h4>
                <ul class="noti-list">
                    @forelse ($allNotifications as $noti)
                    <li class="noti-item">
                        <strong>{{ $noti->title }}</strong>
                        <div class="noti-content">{{ $noti->content }}</div>
                        <div class="noti-meta">Thời gian gửi: {{ $noti->created_at->format('d/m/Y H:i') }}</div>
                    </li>
                    @empty
                    <li class="noti-item">Không có thông báo.</li>
                    @endforelse
                </ul>
            </div>

            {{-- 2. Toàn bộ tổ chức --}}
            <div class="noti-section">
                <h4>🏢 Thông báo gửi tới toàn bộ tổ chức</h4>
                <ul class="noti-list">
                    @forelse ($organizationNotifications as $noti)
                    <li class="noti-item">
                        <strong>{{ $noti->title }}</strong>
                        <div class="noti-content">{{ $noti->content }}</div>
                        <div class="noti-meta">Thời gian gửi: {{ $noti->created_at->format('d/m/Y H:i') }}</div>
                    </li>
                    @empty
                    <li class="noti-item">Không có thông báo.</li>
                    @endforelse
                </ul>
            </div>

            {{-- 3. Gửi tổ chức cụ thể --}}
            <div class="noti-section">
                <h4>🏬 Thông báo gửi đến tổ chức cụ thể</h4>
                <ul class="noti-list">
                    @forelse ($specificOrgNotifications as $noti)
                    <li class="noti-item">
                        <strong>{{ $noti->title }}</strong>
                        <div class="noti-meta">
                            Gửi đến: {{ $noti->organization->username ?? 'Không rõ tổ chức' }}
                        </div>
                        <div class="noti-content">{{ $noti->content }}</div>
                        <div class="noti-meta">Thời gian gửi: {{ \Carbon\Carbon::parse($noti->created_at)->format('d/m/Y H:i') }}</div>
                    </li>
                    @empty
                    <li class="noti-item">Không có thông báo gửi đến tổ chức cụ thể.</li>
                    @endforelse
                </ul>
            </div>

            {{-- 4. Gửi sự kiện cụ thể --}}
            <div class="noti-section">
                <h4>🎯 Thông báo gửi đến sự kiện cụ thể</h4>
                <ul class="noti-list">
                    @forelse ($eventNotifications as $noti)
                    <li class="noti-item">
                        <strong>{{ $noti->title }}</strong>
                        <div class="noti-meta">
                            Gửi đến: {{ $noti->event->name ?? 'Không rõ sự kiện' }}
                        </div>
                        <div class="noti-content">{{ $noti->content }}</div>
                        <div class="noti-meta">Thời gian gửi: {{ $noti->created_at->format('d/m/Y H:i') }}</div>
                    </li>
                    @empty
                    <li class="noti-item">Không có thông báo.</li>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>
</div>
@endsection