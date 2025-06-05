@extends('layouts.master')
@section('content')
    <style>
        .search-bar {
            max-width: 500px;
            margin: 0 auto;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 25px;
            padding: 6px 12px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .search-bar input {
            border: none;
            outline: none;
            flex: 1;
            font-size: 15px;
            padding: 8px;
            background-color: transparent;
        }

        .search-bar i {
            color: #888;
            margin-right: 8px;
            font-size: 18px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 30px
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-logo {
            width: 60px;
            height: 60px;
            margin-right: 15px;
            border-radius: 50%;
            object-fit: cover;
        }

        .card-title {
            flex: 1;
        }

        .card-title h2 {
            font-size: 16px;
            margin: 0 0 5px 0;
            font-weight: 600;
            color: #333;
        }

        .card-username {
            color: #666;
            font-size: 14px;
        }

        .divider {
            height: 1px;
            background-color: #eee;
            margin: 15px 0;
        }

        .card-info p {
            margin: 8px 0;
            font-size: 14px;
        }

        .donation-amount {
            font-weight: bold;
            color: #000;
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

        .mascot {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
        }
    </style>

<div class="container">
    
    <h1 style="text-align: center;">Danh Sách Tổ chức</h1>
    <div class="card-grid">
        @foreach($organizations as $org)
        <div class="card" onclick="window.location='{{ route('organization.detail', $org->organization_id) }}'" style="cursor:pointer;">
            <div class="card-header">
                <img src="{{ asset('images/' . $org->avatar) }}" alt="Logo tổ chức" class="card-logo">
                <div class="card-title">
                    <h2>{{ $org->username }}</h2>
                    <div class="card-username">{{ $org->representative }}</div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="card-info">
                <p>Điện thoại: {{ $org->phone }}</p>
                <p>Địa chỉ: {{ $org->address }}</p>
                <p>Ngày thành lập: {{ \Carbon\Carbon::parse($org->founded_at)->format('d/m/Y') }}</p>
                @if($org->description)
                    <p>Mô tả: {{ Str::limit($org->description, 100) }}</p>
                @endif
            </div>
            @if($org->website)
                <a href="{{ $org->website }}" class="view-details" target="_blank">Xem chi tiết ›</a>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
