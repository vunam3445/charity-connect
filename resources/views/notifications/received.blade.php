@extends('layouts.master')

@section('content')
<style>
    .received-notifications {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        font-family: 'Segoe UI', sans-serif;
    }

    .received-notifications h2 {
        text-align: center;
        color: #2c3e50;
        font-size: 24px;
        margin-bottom: 30px;
        font-weight: bold;
    }

    .noti-card {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        border-left: 5px solid #3498db;
        transition: background 0.3s ease;
    }

    .noti-card:hover {
        background: #eef7ff;
    }

    .noti-title {
        font-size: 18px;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .noti-source {
        font-size: 15px;
        color: #007bff;
        margin-bottom: 6px;
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

    .noti-link {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }

    .noti-link:hover {
        text-decoration: underline;
    }
</style>

<div class="received-notifications">
    <h2>📨 Danh sách thông báo bạn đã nhận</h2>

    @forelse ($notifications as $noti)
    <div class="noti-card">
        <div class="noti-title">{{ $noti->title }}</div>
        <div class="noti-source">
            @if(isset($noti->event_id))
            @php
            $event = \App\Models\Event::find($noti->event_id);
            @endphp
            Gửi từ sự kiện:
            @if ($event)
            <a class="noti-link" href="{{ route('event.show', ['id' => $event->event_id]) }}">
                {{ $event->name }}
            </a>
            @else
            <span class="noti-link">Không rõ</span>
            @endif
            @else
            Gửi từ: Hệ thống
            @endif
        </div>
        <div class="noti-content">{{ $noti->content }}</div>
        <div class="noti-time">Thời gian gửi: {{ \Carbon\Carbon::parse($noti->created_at)->format('d/m/Y H:i') }}</div>
    </div>
    @empty
    <div class="noti-card">
        <div class="noti-title">Bạn chưa nhận được thông báo nào.</div>
    </div>
    @endforelse
</div>
@endsection