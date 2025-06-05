@extends('admin.admin')
@section('styles')
    <style>
        .page-title {
            margin-bottom: 20px;
            font-weight: 600;
            color: #343a40;
        }

        .timeline {
            position: relative;
            margin: 0 0 30px 0;
            padding: 0;
            list-style: none;
        }

        .timeline>div {
            position: relative;
            margin-right: 10px;
            margin-bottom: 15px;
        }

        .timeline>div>i {
            position: absolute;
            top: 0;
            left: 0;
            width: 30px;
            height: 30px;
            font-size: 12px;
            line-height: 30px;
            text-align: center;
            color: #fff;
            border-radius: 50%;
            background-color: #007bff;
        }

        .timeline-item {
            margin-left: 60px;
            padding: 2px 15px;
            background-color: #f8f9fa;
            border-radius: 3px;
            border-left: 3px solid #007bff;
        }

        .timeline-header {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
            color: #495057;
        }

        .timeline-body {
            margin-top: 5px;
            color: #6c757d;
        }

        .time-label {
            position: relative;
            margin-bottom: 20px;
        }

        .time-label>span {
            display: inline-block;
            padding: 5px 10px;
            font-weight: 600;
            border-radius: 4px;
            color: #fff;
        }

        .time {
            float: right;
            color: #999;
        }

        .badge {
            padding: 6px 12px;
            font-weight: 500;
            font-size: 0.85rem;
            border-radius: 20px;
        }

        .action-buttons {
            display: flex;
        }

        .custom-control-input:checked~.custom-control-label::before {
            background-color: #28a745;
            border-color: #28a745;
        }

        /* Carousel và thumbnails */
        .carousel-item img {
            height: 400px;
            object-fit: cover;
        }

        .event-thumbnails {
            overflow-x: auto;
            white-space: nowrap;
            padding-bottom: 5px;
        }

        .event-thumb {
            width: 80px;
            cursor: pointer;
            margin-right: 8px;
            opacity: 0.7;
            transition: opacity 0.3s ease;
            border: 2px solid transparent;
        }

        .event-thumb.active {
            opacity: 1;
            border: 2px solid #007bff;
        }

        .event-thumb:hover {
            opacity: 1;
        }

        .event-thumb img {
            width: 100%;
            height: 60px;
            object-fit: cover;
        }

        .event-thumb-more {
            min-width: 80px;
            height: 60px;
            background-color: #f8f9fa;
            cursor: pointer;
            color: #007bff;
            font-size: 0.8rem;
            border-radius: 0.25rem;
        }

        .event-thumb-more:hover {
            background-color: #e9ecef;
        }

        /* Image Gallery trong Modal */
        .event-image-card {
            position: relative;
            overflow: hidden;
        }

        .event-image-card img {
            height: 180px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .event-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .event-image-card:hover .event-image-overlay {
            opacity: 1;
        }

        .event-image-card:hover img {
            transform: scale(1.05);
        }

        .event-image-actions {
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <h2 class="page-title">Chi tiết sự kiện</h2>

                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Phần header và hình ảnh sự kiện -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <h1 class="h3">{{ $event->name }}</h1>
                                    <span
                                        class="badge badge-{{ $event->approved === 'approved' ? 'success' : ($event->approved === 'rejected' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($event->approved) }}
                                    </span>

                                </div>
                                <p class="mb-1 text-muted">
                                    <i class="mr-2 fas fa-building"></i>
                                    Tổ chức: <strong>{{ $event->organization->username }}</strong>
                                </p>
                                {{-- <p class="text-muted">
                                    <i class="mr-2 fas fa-calendar-check"></i>
                                    ID: <span class="text-monospace">{{ $event->event_id }}</span>
                                </p> --}}
                            </div>
                        </div>
                    </div>
                    @if ($event->approved == 'pending')
                        <div class="col-md-4">
                            <div class="card">

                                <div class="card-body">

                                    <div class="mb-3 d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Hành động</h5>
                                    </div>
                                    <div class="action-buttons">
                                        <button class="mr-2 btn btn-success" data-toggle="modal"
                                            data-target="#approveModal">
                                            <i class="mr-2 fas fa-check-circle"></i>Phê duyệt
                                        </button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#rejectModal">
                                            <i class="mr-2 fas fa-times-circle"></i>Từ chối
                                        </button>
                                    </div>

                                </div>
                            </div>
                    @endif
                </div>
            </div>

            <div class="mt-3 row">
                <!-- Cột thông tin sự kiện -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <!-- Carousel hình ảnh sự kiện -->
                            <div class="mb-4">
                                <h5 class="mb-3">Hình ảnh sự kiện</h5>
                                @php
                                    $images = [];
                                    if (!empty($event->images)) {
                                        if (is_string($event->images)) {
                                            $images = array_filter(explode(';', $event->images));
                                        } elseif (is_array($event->images)) {
                                            $images = $event->images;
                                        }
                                    }
                                    $firstImage = $images[0] ?? 'default-event.jpg';
                                @endphp
                                <!-- Carousel Main Image -->
                                <div id="eventImageCarousel" class="carousel slide" data-ride="carousel">

                                    <div class="rounded carousel-inner">
                                        <div class="carousel-item active">

                                            @if (file_exists(public_path($firstImage)))
                                                <img src="{{ asset($firstImage) }}" alt="{{ $event->name }}"
                                                    class="event-image" id="main-image">
                                            @else
                                                <img src="{{ asset('images/default-event.jpg') }}" alt="Hình mặc định"
                                                    class="event-image" id="main-image">
                                            @endif

                                        </div>
                                        {{-- <div class="carousel-item">
                                            <img src="{{ explode(';', $event->image)[1] }}" class="d-block w-100"
                                                alt="Hình ảnh sự kiện 2">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{ explode(';', $event->image)[2] }}" class="d-block w-100"
                                                alt="Hình ảnh sự kiện 3">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{ explode(';', $event->image)[3] }}" class="d-block w-100"
                                                alt="Hình ảnh sự kiện 4">
                                        </div> --}}
                                        @if (!empty($images))
                                            <div class="image-navigation">
                                                @foreach ($images as $index => $image)
                                                    <div class="image-nav-dot {{ $index === 0 ? 'active' : '' }}"
                                                        data-image="{{ asset($image) }}"></div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                </div>

                                <!-- Image Thumbnails -->
                                <div class="mt-3 event-thumbnails d-flex">
                                    @foreach ($images as $index => $image)
                                        <div class="event-thumb active" data-target="#eventImageCarousel" data-slide-to="0">
                                            <img src="{{ asset($image) }}"
                                                class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                                                alt="Thumbnail {{ $index + 1 }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <h5 class="mb-3">Mô tả sự kiện</h5>
                            <p>{{ $event->description }}</p>

                            <div class="mt-4 row">
                                <div class="col-md-6">
                                    <div class="pb-3 mb-3 border-bottom">
                                        <div class="font-weight-bold">
                                            <i class="mr-2 far fa-calendar-alt"></i>Thời gian bắt đầu
                                        </div>
                                        <div class="text-muted">
                                            {{ $event->start_date }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pb-3 mb-3 border-bottom">
                                        <div class="font-weight-bold">
                                            <i class="mr-2 far fa-calendar-check"></i>Thời gian kết thúc
                                        </div>
                                        <div class="text-muted">
                                            {{ $event->end_date }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pb-3 mb-3 border-bottom">
                                <div class="font-weight-bold">
                                    <i class="mr-2 fas fa-map-marker-alt"></i>Địa điểm
                                </div>
                                <div class="text-muted">
                                    {{ $event->location }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="pb-3 mb-3 border-bottom">
                                        <div class="font-weight-bold">
                                            <i class="mr-2 fas fa-user-minus"></i>Số người tối thiểu
                                        </div>
                                        <div class="text-muted">
                                            {{ $event->min_quantity }} người
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="pb-3 mb-3 border-bottom">
                                        <div class="font-weight-bold">
                                            <i class="mr-2 fas fa-user-plus"></i>Số người tối đa
                                        </div>
                                        <div class="text-muted">
                                            {{ $event->max_quantity }} người
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="pb-3 mb-3 border-bottom">
                                        <div class="font-weight-bold">
                                            <i class="mr-2 fas fa-users"></i>Đã đăng ký
                                        </div>
                                        <div class="text-muted">
                                            {{ $event->quantity_now }} người
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pb-3 mb-3 border-bottom">

                            </div>

                            {{-- <div class="mt-3">
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Trạng thái sự kiện</h5>
                                    
                                </div>
                                <p class="mb-2 small text-muted">Thay đổi trạng thái hoạt động của sự kiện</p>
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">Kết thúc</span>
                                    <div class="mx-2 custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="statusSwitch" {{ $event->status == 'active' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="statusSwitch"></label>
                                    </div>
                                    <span class="ml-2">Hoạt động</span>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <!-- Cột thông tin bổ sung -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Thông tin bổ sung</h5>

                            <div class="pb-3 mb-3 border-bottom">
                                <div class="font-weight-bold">
                                    <i class="mr-2 fas fa-clock"></i>Thời gian tạo
                                </div>
                                <div class="text-muted">
                                    {{ $event->created_at->format('d/m/Y') }}
                                </div>
                            </div>

                            <div class="pb-3 mb-3 border-bottom">
                                <div class="font-weight-bold">
                                    <i class="mr-2 fas fa-edit"></i>Cập nhật lần cuối
                                </div>
                                <div class="text-muted">
                                    {{ $event->updated_at->format('d/m/Y') }}
                                </div>
                            </div>

                            <div class="pb-3 mb-3 border-bottom">
                                <div class="font-weight-bold">
                                    <i class="mr-2 fas fa-user-tie"></i>Người đại diện tổ chức
                                </div>
                                <div class="text-muted text-truncate">
                                    <small>{{ $event->organization->representative }}</small>
                                </div>
                            </div>

                            <div class="pb-3 mb-3 border-bottom">
                                <div class="font-weight-bold">
                                    <i class="mr-2 fas fa-sticky-note"></i>Ghi chú
                                </div>
                                <div class="text-muted text-truncate">
                                    <small>{{ $event->note ?? 'Chưa có ghi chú' }}</small>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="pb-3 mb-3 border-bottom">
                                <div class="font-weight-bold">
                                    <i class="mr-2 fas fa-envelope"></i>Email
                                </div>
                                <div class="text-muted text-truncate">
                                    <small>{{ $event->organization->email ?? 'Chưa có email' }}</small>
                                </div>
                            </div>

                            <!-- Địa chỉ -->
                            <div class="pb-3 mb-3 border-bottom">
                                <div class="font-weight-bold">
                                    <i class="mr-2 fas fa-map-marker-alt"></i>Địa chỉ
                                </div>
                                <div class="text-muted text-truncate">
                                    <small>{{ $event->organization->address ?? 'Chưa có địa chỉ' }}</small>
                                </div>
                            </div>

                            <!-- Số điện thoại -->
                            <div class="pb-3 mb-3 border-bottom">
                                <div class="font-weight-bold">
                                    <i class="mr-2 fas fa-phone"></i>Số điện thoại
                                </div>
                                <div class="text-muted text-truncate">
                                    <small>{{ $event->organization->phone ?? 'Chưa có số điện thoại' }}</small>
                                </div>
                            </div>

                            <!-- Website -->
                            <div class="pb-3 mb-3 border-bottom">
                                <div class="font-weight-bold">
                                    <i class="mr-2 fas fa-globe"></i>Website
                                </div>
                                <div class="text-muted text-truncate">
                                    <small>
                                        @if (!empty($event->organization->website))
                                            <a href="{{ $event->organization->website }}" target="_blank"
                                                rel="noopener noreferrer">{{ $event->organization->website }}</a>
                                        @else
                                            Chưa có website
                                        @endif
                                    </small>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Modal Phê duyệt -->
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-hidden="true">
        <form method="POST" action="{{ route('admin.events.approve', ['id' => $event->event_id]) }}">
            @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xác nhận phê duyệt</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">
                            Bạn có chắc chắn muốn phê duyệt sự kiện này?
                            <br>
                            <strong>{{ $event->name }}</strong>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-success">Xác nhận phê duyệt</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Từ chối -->
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-hidden="true">
        <form method="POST" action="{{ route('admin.events.reject', ['id' => $event->event_id]) }}">
            @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xác nhận từ chối</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-3">Vui lòng cung cấp lý do từ chối sự kiện này:</p>
                        <textarea class="form-control" name="note" rows="4" placeholder="Nhập lý do từ chối..."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-danger">Xác nhận từ chối</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- Modal Xem tất cả hình ảnh -->
    <!-- Modal xem chi tiết ảnh -->
    <div class="modal fade" id="viewImageModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-body p-0 text-center">
                    <img id="viewImageModalImg" src="" alt="Chi tiết ảnh"
                        style="max-width: 100%; max-height: 80vh;" />
                </div>
            </div>
        </div>
    </div>



    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    {{-- Hiển thị thông báo lỗi từ session (ví dụ dùng session('error') để báo lỗi tùy chỉnh) --}}
    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    {{-- Hiển thị lỗi validation (lấy lỗi đầu tiên) --}}
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi dữ liệu!',
                    text: '{{ $errors->first() }}',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
@endsection


@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainImage = document.getElementById('main-image');
            const modalImg = document.getElementById('viewImageModalImg');
            const viewImageModal = new bootstrap.Modal(document.getElementById('viewImageModal'));

            mainImage.addEventListener('click', function() {
                const imgSrc = this.getAttribute('src');
                modalImg.setAttribute('src', imgSrc);
                viewImageModal.show();
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            const mainImage = document.getElementById('main-image');
            const thumbs = document.querySelectorAll('.event-thumb img');

            thumbs.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    const src = this.getAttribute('src');
                    mainImage.setAttribute('src', src);

                    // Loại bỏ class 'active' ở tất cả thumbnails
                    thumbs.forEach(t => t.classList.remove('active'));

                    // Thêm class 'active' vào thumbnail được click
                    this.classList.add('active');
                });
            });
        });
    </script>
@endsection
