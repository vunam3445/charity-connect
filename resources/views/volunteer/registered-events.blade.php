@extends('layouts.master')

@section('title', 'Danh sách sự kiện đã đăng ký')

@section('content')
    <div class="container mt-5">
        <!-- Hiển thị thông báo nếu có -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <h2 class="mb-4">Danh sách sự kiện đã đăng ký</h2>

        @if ($events->isEmpty())
            <div class="alert alert-info" role="alert">
                Bạn chưa đăng ký tham gia sự kiện nào.
            </div>
        @else
            <div class="row">
                @foreach ($events as $event)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100" onclick="goToEvent('{{ $event->event_id }}')">
                            @php
                                $images = $event->images ? (is_array($event->images) ? $event->images : json_decode($event->images, true)) : [];
                                $firstImage = !empty($images) ? $images[0] : 'images/default-event.jpg';
                            @endphp
                            <img src="{{ asset('images/' . $firstImage) }}" class="card-img-top" alt="{{ $event->name }}" style="height: 200px; object-fit: cover;" onerror="this.src='{{ asset('images/default-event.jpg') }}'">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->name }}</h5>
                                <p class="card-text">
                                    <strong>Thời gian:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} - 
                                    {{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') : 'Đang cập nhật' }}<br>
                                    <strong>Địa điểm:</strong> {{ $event->location }}<br>
                                    <strong>Số lượng:</strong> {{ $event->quantity_now }}/{{ $event->max_quantity }}<br>
                                    <strong>Tổ chức:</strong> {{ $event->organization->username ?? 'Không xác định' }}
                                </p>
                                <form action="{{ route('events.unregister', $event->event_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn hủy tham gia sự kiện này?')">
                                        <i class="fas fa-times"></i> Hủy tham gia
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .card {
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-img-top {
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        @media (max-width: 768px) {
            .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
@endsection

@section('scripts')
  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function goToEvent(eventId) {
                window.location.href = '/event/' + eventId;
            }
    </script>  
@endsection