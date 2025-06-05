@extends('layouts.master')

@section('content')
<style>
    .org-notifications {
        max-width: 960px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        font-family: 'Segoe UI', sans-serif;
    }

    .org-notifications h2 {
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

    .noti-event {
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
</style>

<div class="org-notifications">
    <h2>📨 Danh sách thông báo đã gửi</h2>

    @forelse ($notifications as $noti)
    <div class="noti-card">
        <div class="noti-event">Sự kiện: {{ $noti->event->name ?? 'Không rõ' }}</div>
        <div class="noti-title">{{ $noti->title }}</div>
        <div class="noti-content">{{ $noti->content }}</div>
        <div class="noti-time">Thời gian gửi: {{ $noti->created_at->format('d/m/Y H:i') }}</div>
    </div>
    @empty
    <div class="noti-card">
        <div class="noti-title">Chưa có thông báo nào được gửi.</div>
    </div>
    @endforelse
</div>
@endsection