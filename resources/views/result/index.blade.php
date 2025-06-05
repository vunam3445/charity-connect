@extends('layouts.master')

@section('title', 'Danh sách Kết quả')

@section('styles')
<style>
    .page-wrapper {
        padding: 20px;
        font-family: Arial, sans-serif;
        background-color: #fafafa;
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
        transition: transform 0.3s, box-shadow 0.3s;
        cursor: pointer;
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
        <h1>Danh sách kết quả các chiến dịch</h1>

        <div class="grid-container" id="result-list">
            @foreach ($results as $result)
            <div class="card" onclick="redirectToResult('{{ $result->result_id }}')">
                @php
                $images = array_filter(array_map('trim', explode(';', $result->images ?? '')));
                @endphp
                @if (!empty($images))
                <img src="{{ asset($images[0]) }}" alt="Ảnh minh họa">
                @endif

                <div class="card-body">
                    <h2>{{ $result->event->name ?? 'Không rõ tên chiến dịch' }}</h2>
                    <p><strong>Địa điểm:</strong> {{ $result->event->location ?? 'Không rõ' }}</p>
                    <p><strong>Mô tả:</strong> {{ \Illuminate\Support\Str::limit($result->event->description, 60) }}</p>
                    <p><strong>Nội dung kết quả:</strong> {{ \Illuminate\Support\Str::limit($result->content, 100) }}</p>
                </div>
            </div>
            @endforeach
        </div>

        @if ($hasMore)
        <div class="load-more-wrapper">
            <button class="btn-load-more" id="load-more-btn">Xem thêm</button>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    let offset = 9;

    function redirectToResult(resultId) {
        window.location.href = '/result/' + resultId;
    }

    document.getElementById('load-more-btn')?.addEventListener('click', function() {
        fetch(`/result/load-more?offset=${offset}`)
            .then(response => response.json())
            .then(data => {
                const results = data.results;

                let html = '';
                results.forEach(result => {
                    html += `
                <div class="card" onclick="redirectToResult('${result.result_id}')">
                    ${result.images ? `<img src="${result.images.split(';')[0].trim()}" alt="Ảnh minh họa">` : ''}
                    <div class="card-body">
                        <h2>${result.event_name ?? 'Không rõ tên chiến dịch'}</h2>
                        <p><strong>Địa điểm:</strong> ${result.location ?? 'Không rõ'}</p>
                        <p><strong>Mô tả:</strong> ${truncateText(result.description, 60)}</p>
                        <p><strong>Nội dung kết quả:</strong> ${truncateText(result.content, 100)}</p>
                    </div>
                </div>`;
                });

                document.getElementById('result-list').insertAdjacentHTML('beforeend', html);
                offset += results.length;

                if (!data.hasMore) {
                    document.getElementById('load-more-btn').style.display = 'none';
                }
            })
            .catch(error => console.error('Lỗi khi tải thêm:', error));
    });

    function truncateText(text, maxLength) {
        if (!text) return '';
        return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
    }
</script>
@endsection