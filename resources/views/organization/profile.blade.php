@extends('layouts.master')

@section('styles')
<style>
    body {
        background-color: #f0f2f5;
    }

    .cover-section {
        position: relative;
        height: 350px;
        background-image: url('{{ asset("images/" . $organization->cover) }}');
        background-size: cover;
        background-position: center;
        border-radius: 0;
        margin-bottom: 15px;
    }

    .profile-container {
        position: relative;
        padding-left: 200px;
        margin-bottom: 20px;
    }

    .org-avatar-container {
        position: absolute;
        bottom: 15px;
        left: 15px;
        z-index: 10;
    }

    .org-avatar {
        width: 170px;
        height: 170px;
        object-fit: cover;
        border: 4px solid #fff;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        position: relative;
        top: -30px;
    }

    .org-info {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding-bottom: 10px;
    }

    /* Avatar */
    .post-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 10px;
    }

    /* Hình ảnh chính */
    .event-images {
        display: flex;
        gap: 12px;
        margin-bottom: 1rem;
        align-items: flex-start;
        flex-wrap: nowrap;
        /* Quan trọng: không cho xuống dòng */
    }

    .event-images .main-img-wrapper {
        flex: 1 1 60%;
        max-width: 60%;
    }

    .event-images .main-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
        aspect-ratio: 4/3;
    }

    .event-images .sub-img-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 6px;
        flex: 1 1 40%;
        max-width: 40%;
    }

    .sub-img-grid img {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 6px;
    }





    .nav-tabs .nav-tap {
        color: #65676B;
        font-weight: 600;
        padding: 16px 20px;
        border: none;
        border-radius: 0;
    }

    .nav-tabs .nav-tap.active {
        color: #ff5722;
        border-bottom: 3px solid #ff5722;
        background-color: transparent;
    }

    .nav-tabs .nav-tap:hover:not(.active) {
        background-color: rgba(0, 0, 0, 0.05);
        border-radius: 6px;
    }

    .info-card {
        transition: all 0.3s;
        border-radius: 8px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        background-color: white;
    }

    .post-card {
        margin-bottom: 20px;
        border-radius: 8px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .post-header {
        display: flex;
        align-items: center;
        padding: 12px;
    }

    .post-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .post-meta {
        flex-grow: 1;
    }

    .post-actions {
        display: flex;
        border-top: 1px solid #ddd;
        padding: 8px;
    }

    .post-action {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 8px;
        border-radius: 4px;
        cursor: pointer;
    }

    .post-action:hover {
        background-color: #f0f2f5;
    }

    @media (max-width: 768px) {
        .profile-container {
            padding-left: 0;
            text-align: center;
        }

        .org-avatar-container {
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            bottom: auto;
            margin-bottom: 20px;
        }

        .org-info {
            padding-left: 15px;
            padding-right: 15px;
            align-items: center;
        }
    }

    .section-title {
        position: relative;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        /* background-color: #1877F2; */
    }

    .fb-btn {
        background-color: #ff5722;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 8px 16px;
        font-weight: 600;
    }

    .fb-btn:hover {
        background-color: #166FE5;
        color: white;
    }

    .fb-btn-outline {
        background-color: #E4E6EB;
        color: #050505;
        border: none;
        border-radius: 6px;
        padding: 8px 16px;
        font-weight: 600;
    }

    .fb-btn-outline:hover {
        background-color: #d8dadf;
    }

    .container.py-3 {
        padding-top: 0.1rem !important;
    }

    .nav-tap {
        text-decoration: none;
    }

    .nav-tap:hover {
        text-decoration: none;
    }

    .nav-tabs {
        border-bottom: none !important;
    }

    .bottom-0.mb-3.position-absolute.end-0.me-3 {
        bottom: 20px;
        left: 8rem;
    }

    .event-images .main-img {
        height: 240px;
        object-fit: cover;
    }

    .event-images .sub-img {
        height: 115px;
        object-fit: cover;
    }

    .img-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .img-grid .sub-img-wrapper {
        width: calc(50% - 3px);
        /* 2 ảnh/row với khoảng cách */
    }
</style>
@endsection



@section('content')
<div class="container py-3">
    <!-- Cover Section với Avatar và thông tin cơ bản -->
    <div class="mb-3 position-relative">
        <div class="cover-section">
            <!-- Cover image is set as background in CSS -->
            <div class="top-0 m-3 position-absolute end-0">
                <form action="/organization/{{ $organization->organization_id }}/upload-cover" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="cover_image" onchange="this.form.submit()" hidden id="coverInput">
                    <button type="button" class="btn btn-light" onclick="document.getElementById('coverInput').click()">
                        <i class="fas fa-camera me-1"></i> Thêm ảnh bìa
                    </button>
                </form>
            </div>
        </div>

        <div class="container">
            <div class="profile-container">
                <div class="org-avatar-container">
                    <img src="{{ asset('images/' . $organization->avatar) }}" alt="Avatar" class="org-avatar">
                    <div class="bottom-0 mb-3 position-absolute end-0 me-3">
                        <form action="/organization/{{ $organization->organization_id }}/upload-avatar" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="avatar_image" onchange="this.form.submit()" hidden id="avatarInput">
                            <button type="button" class="p-2 btn btn-light rounded-circle" onclick="document.getElementById('avatarInput').click()">
                                <i class="fas fa-camera me-1"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="org-info">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end">
                        <div>
                            <h1 class="mb-1 fw-bold">{{$organization->username}}</h1>
                            <p class="mb-1 text-muted">
                                <i class="fas fa-user me-2"></i>
                                Người đại diện: <strong>{{$organization->representative}}</strong>
                            </p>
                            <p class="mb-2 text-muted">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Thành lập: <strong>{{$organization->founded_at}}</strong>
                            </p>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <ul class="mb-4 nav nav-tabs">
        <li class="nav-item">
            <a class="nav-tap active" href="#" id="tab-su-kien">Sự kiện</a>
        </li>
        <li class="nav-item">
            <a class="nav-tap" href="#" id="tab-ket-qua">Kết quả</a>
        </li>
    </ul>

    <!-- Thông tin chi tiết -->
    <div class="row">
        <!-- Cột bên trái -->
        <div class="col-md-5 col-lg-4">
            <!-- Mô tả tổ chức -->
            <div class="mb-4">
                <div class="card info-card">
                    <div class="bg-white card-header">
                        <h5 class="mb-0 section-title">Mô tả tổ chức</h5>
                    </div>
                    <div class="card-body">
                        <p>{{$organization->description}}</p>
                    </div>
                </div>
            </div>

            <!-- Thông tin liên hệ -->
            <div class="mb-4">
                <div class="card info-card">
                    <div class="bg-white card-header">
                        <h5 class="mb-0 section-title">Thông tin liên hệ</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="px-0 border-0 list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded bg-light">
                                            <i class="fas fa-envelope text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0">{{$organization->email}}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="px-0 border-0 list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded bg-light">
                                            <i class="fas fa-phone text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0">{{$organization->phone}}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="px-0 border-0 list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded bg-light">
                                            <i class="fas fa-map-marker-alt text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0">{{$organization->address}}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cột bên phải - Nội dung posts -->
        <div class="col-md-7 col-lg-8">


            <!-- Content container cho các tab -->


            <div id="content-su-kien" class="tab-content">
                @forelse($events as $event)
                @php
                $images = array_filter(array_map('trim', explode(';', $event->image ?? '')));
                $avatar = asset('images/' . ($event->organization->avatar ?? '06d76108-7435-4859-b7c8-0e6fd667763f.jpg'));
                @endphp
                <div class="card post-card">
                    <div class="post-header">
                        <img src="{{ $avatar }}" alt="Avatar" class="post-avatar">
                        <div class="post-meta">
                            <h6 class="mb-0">{{ $organization->username }}</h6>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($event->created_at)->translatedFormat('d \\t\\há\\n\\g m, Y') }}</small>
                        </div>
                    </div>
                    <div class="pt-0 card-body">
                        <h5 class="card-title">{{ $event->name }}</h5>

                        @if (count($images) > 0)
                        <div class="event-images">
                            {{-- Ảnh chính bên trái --}}
                            <div class="main-img-wrapper">
                                <img src="{{ asset($images[0]) }}" alt="Ảnh chính">
                            </div>

                            {{-- Ảnh phụ bên phải (tối đa 4) --}}
                            @if (count($images) > 1)
                            <div class="sub-img-grid">
                                @foreach(array_slice($images, 1, 4) as $img)
                                <img src="{{ asset($img) }}" alt="Ảnh phụ">
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endif


                        <p><strong>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</strong> | {{ $event->location }}</p>
                        <p>{{ $event->description }}</p>
                        <div class="gap-2 d-flex">
                            <a href="{{ route('event.show', $event->event_id) }}" class="fb-btn">
                                <i class="fas fa-eye me-1"></i> Xem chi tiết
                            </a>
                            <button class="fb-btn-outline"><i class="fas fa-share me-1"></i> Chia sẻ</button>
                        </div>
                    </div>
                </div>
                @empty
                <p>Không có sự kiện nào.</p>
                @endforelse
            </div>




            <div id="content-ket-qua" class="tab-content" style="display:none;">
                @forelse ($results as $result)
                @php
                $images = array_filter(array_map('trim', explode(';', $result->images ?? '')));
                $avatar = asset('images/' . ($result->event->organization->avatar ?? '06d76108-7435-4859-b7c8-0e6fd667763f.jpg'));
                @endphp
                <div class="card post-card">
                    <div class="post-header">
                        <img src="{{ $avatar }}" alt="Avatar" class="post-avatar">
                        <div class="post-meta">
                            <h6 class="mb-0">{{ $result->event->organization->username ?? 'Tổ chức' }}</h6>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($result->created_at)->translatedFormat('d \\t\\há\\n\\g m, Y') }}</small>
                        </div>
                    </div>

                    <div class="pt-0 card-body">
                        <h5>Sự Kiện: {{ $result->event->name ?? 'Tên sự kiện' }}</h5>
                        <h5 class="card-title">{{ \Illuminate\Support\Str::limit($result->content, 150) }}</h5>

                        @if (count($images) > 0)
                        <div class="event-images">
                            {{-- Ảnh chính bên trái --}}
                            <div class="main-img-wrapper">
                                <img src="{{ asset($images[0]) }}" alt="Ảnh chính">
                            </div>

                            {{-- Ảnh phụ bên phải (tối đa 4) --}}
                            @if (count($images) > 1)
                            <div class="sub-img-grid">
                                @foreach(array_slice($images, 1, 4) as $img)
                                <img src="{{ asset($img) }}" alt="Ảnh phụ">
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endif


                        <div class="gap-2 d-flex">
                            <a href="{{ route('result.show', $result->result_id) }}" class="fb-btn">
                                <i class="fas fa-check-circle me-1"></i> Xem chi tiết
                            </a>
                            <button class="fb-btn-outline"><i class="fas fa-share me-1"></i> Chia sẻ</button>
                        </div>
                    </div>
                </div>
                @empty
                <p>Chưa có kết quả nào.</p>
                @endforelse
            </div>



        </div>

    </div>
    @endsection

    @section('scripts')
    <script>
        document.getElementById('tab-su-kien').addEventListener('click', function(event) {
            event.preventDefault(); // ⚠️ Ngăn reload hoặc cuộn lên
            this.classList.add('active');
            document.getElementById('tab-ket-qua').classList.remove('active');
            document.getElementById('content-su-kien').style.display = 'block';
            document.getElementById('content-ket-qua').style.display = 'none';
        });

        document.getElementById('tab-ket-qua').addEventListener('click', function(event) {
            event.preventDefault(); // ⚠️ Ngăn reload hoặc cuộn lên
            this.classList.add('active');
            document.getElementById('tab-su-kien').classList.remove('active');
            document.getElementById('content-su-kien').style.display = 'none';
            document.getElementById('content-ket-qua').style.display = 'block';
        });
    </script>
    @endsection