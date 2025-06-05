@extends('layouts.master')

@section('title', 'Danh sách Chiến dịch')

@section('styles')
<style>
    .page-wrapper {
        padding: 20px;
        background-color: #fafafa;
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
        color: #e67e22;
        font-weight: 700;
        margin-bottom: 30px;
    }

    .main-container {
        max-width: 1200px;
        margin: auto;
    }

    .filter-form {
        margin-bottom: 20px;
    }

    .filter-form select {
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .card-body {
        padding: 15px;
        flex: 1;
    }

    .card-body h2 {
        font-size: 18px;
        margin: 0 0 10px;
        color: #2c3e50;
    }

    .card-body p {
        margin: 4px 0;
        font-size: 14px;
        color: #555;
    }

    .load-more-wrapper {
        width: 100%;
        display: flex;
        justify-content: center;
        margin: 30px 0;
    }

    .btn-load-more {
        background-color: #e67e22;
        color: white;
        border: none;
        padding: 12px 30px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-load-more:hover {
        background-color: #d35400;
    }
</style>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="main-container">
        <h1>Danh sách chiến dịch</h1>

        <div class="filter-form">
            <select id="filter-status">
                <option value="">Tất cả</option>
                <option value="active">Đang thực hiện</option>
                <option value="ended">Đã kết thúc</option>
            </select>
        </div>

        <div class="grid-container" id="event-list">
            @foreach ($events as $event)
            <div class="card" onclick="redirectToDetail('{{ $event->event_id }}')">
                @php
                $images = array_filter(array_map('trim', explode(';', $event->images ?? '')));
                $firstImage = !empty($images) ? $images[0] : 'images/default-event.jpg';
                @endphp
                <img src="{{ asset($firstImage) }}" alt="Ảnh chiến dịch" onerror="this.src='{{ asset('images/default-event.jpg') }}'">

                <div class="card-body">
                    <h2>{{ $event->name }}</h2>
                    <p><strong>Địa điểm:</strong> {{ $event->location }}</p>
                    <p><strong>Đăng ký:</strong> {{ $event->quantity_now }} / {{ $event->max_quantity }}</p>
                    <p><strong>Thời gian:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="load-more-wrapper">
            <button class="btn-load-more" id="load-more-btn">Xem thêm</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let offset = 9;
    let status = '';

    function renderEvents(events) {
        let html = '';
        events.forEach(event => {
            let images = [];
            if (event.images) {
                images = event.images.split(';').map(s => s.trim()).filter(Boolean);
            }
            let firstImage = images.length > 0 ? images[0] : 'images/default-event.jpg';
            html += `
            <div class="card" onclick="location.href='/event/${event.event_id}'">
                <img src="${firstImage}" alt="Ảnh chiến dịch" onerror="this.src='images/default-event.jpg'">
                <div class="card-body">
                    <h2>${event.name}</h2>
                    <p><strong>Địa điểm:</strong> ${event.location}</p>
                    <p><strong>Đăng ký:</strong> ${event.quantity_now} / ${event.max_quantity}</p>
                    <p><strong>Thời gian:</strong> ${new Date(event.start_date).toLocaleDateString('vi-VN')} - ${new Date(event.end_date).toLocaleDateString('vi-VN')}</p>
                </div>
            </div>
            `;
        });
        return html;
    }

    function redirectToDetail(eventId) {
        window.location.href = '/event/' + eventId;
    }

    function loadEvents(reset = false) {
        fetch(`/event/load-more?offset=${reset ? 0 : offset}&status=${status}`)
            .then(response => response.json())
            .then(data => {
                if (reset) {
                    document.getElementById('event-list').innerHTML = '';
                    offset = 0;
                }
                document.getElementById('event-list').insertAdjacentHTML('beforeend', renderEvents(data.events));
                offset += data.events.length;

                if (!data.hasMore) {
                    document.getElementById('load-more-btn').style.display = 'none';
                } else {
                    document.getElementById('load-more-btn').style.display = 'block';
                }
            })
            .catch(error => console.error('Lỗi khi tải sự kiện:', error));
    }

    document.getElementById('load-more-btn').addEventListener('click', () => {
        loadEvents(false);
    });

    document.getElementById('filter-status').addEventListener('change', function() {
        status = this.value;
        loadEvents(true);
    });
</script>
@endsection