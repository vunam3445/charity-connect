@extends('admin.admin')


@section('styles')
<style>
    .cover-section {
        position: relative;
        height: 350px;
        background-image: url('{{ $organization->cover ? asset('images/' . $organization->cover) : asset('images/default-avatar.png') }}');
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

    .profile-actions {
        display: flex;
        margin-top: 10px;
        gap: 10px;
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

        .profile-actions {
            justify-content: center;
        }
    }

    .info-card {
        transition: all 0.3s;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
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
        background-color: #0d6efd;
    }

    .container.py-5 {
        margin-left: 20%;
    }
</style>
@endsection

@section('content')
<div class="container py-5">


    <!-- Cover Section với Avatar và thông tin cơ bản -->
    <div class="position-relative">
        <div class="cover-section">
            <!-- Cover image is set as background in CSS -->
            {{-- <div class="top-0 m-3 position-absolute end-0">
                <button class="btn btn-light">
                    <i class="fas fa-camera me-1"></i> Thêm ảnh bìa
                </button>
            </div> --}}
        </div>

        <div class="container">
            <div class="profile-container">
                <div class="org-avatar-container">
                    <img src="{{ $organization->avatar ? asset('images/' . $organization->avatar) : asset('images/default-image.jpg') }}"
                        alt="Austin Dach" class="org-avatar">
                    <div class="bottom-0 mb-3 position-absolute end-0 me-3">

                    </div>
                </div>

                <div class="org-info">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end">
                        <div>


                            <p class="mb-1 text-muted">
                                <i class="fas fa-user me-2"></i>
                                Tên tổ chức: <strong>{{ $organization->username }}</strong>
                            </p>
                            <p class="mb-2 text-muted">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Thành lập: <strong>{{ $organization->founded_at }}</strong>
                            </p>
                        </div>
                        @if ($organization->approved == 'pending')
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
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thông tin chi tiết -->
        <div class="row">
            <!-- Thông tin liên hệ -->
            <div class="mb-4 col-md-6">
                <div class="card info-card h-100">
                    <div class="bg-white card-header">
                        <h5 class="mb-0 section-title">Thông tin liên hệ</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded bg-light">
                                            <i class="fas fa-envelope text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 fw-bold">Email</h6>
                                        <p class="mb-0"><a
                                                href="mailto:cristobal08@example.org">{{ $organization->email }}</a></p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded bg-light">
                                            <i class="fas fa-phone text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 fw-bold">Điện thoại</h6>
                                        <p class="mb-0">{{ $organization->phone }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded bg-light">
                                            <i class="fas fa-map-marker-alt text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 fw-bold">Địa chỉ</h6>
                                        <p class="mb-0">{{ $organization->address }}</p>
                                    </div>

                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded bg-light">
                                            <i class="fas fa-globe text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 fw-bold">Website</h6>
                                        <p class="mb-0"><a href="{{ $organization->website }}"
                                                target="_blank">{{ $organization->website }}</a></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Thông tin tài khoản -->
            <div class="mb-4 col-md-6">
                <div class="card info-card h-100">
                    <div class="bg-white card-header">
                        <h5 class="mb-0 section-title">Thông tin tài khoản</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded bg-light">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 fw-bold">Tên tổ chức</h6>
                                        <p class="mb-0">{{ $organization->username }}</p>
                                    </div>

                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded bg-light">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 fw-bold">Người đại diện</h6>
                                        <p class="mb-0">{{ $organization->representative }}</p>
                                    </div>

                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded bg-light">
                                            <i class="fas fa-check-circle text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 fw-bold">Trạng thái</h6>
                                        <p class="mb-0">
                                            @switch($organization->approved)
                                            @case('approved')
                                            <span class="badge bg-success">Đã duyệt</span>
                                            @break
                                            @case('pending')
                                            <span class="badge bg-warning">Chờ duyệt</span>
                                            @break
                                            @case('rejected')
                                            <span class="badge bg-danger">Từ chối</span>
                                            @break
                                            @endswitch
                                        </p>
                                    </div>

                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded bg-light">
                                            <span class="text-primary">📝 </span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 fw-bold">Ghi chú: </h6>
                                        @if ($organization->note )
                                        <div class="mt-3 notes-section">

                                            <p class="mb-0">{{ $organization->note }}</p>
                                        </div>
                                        @else
                                        <p class="mb-0">Không có ghi chú nào.</p>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Mô tả -->
            <div class="mb-4 col-md-12">
                <div class="card info-card">
                    <div class="bg-white card-header">
                        <h5 class="mb-0 section-title">Mô tả tổ chức</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $organization->description }}</p>

                    </div>
                </div>
            </div>

            <!-- Thời gian tạo và cập nhật -->
            <div class="mb-4 col-md-12">
                <div class="card info-card">
                    <div class="bg-white card-header">
                        <h5 class="mb-0 section-title">Thông tin hệ thống</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded bg-light">
                                            <i class="fas fa-clock text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 fw-bold">Ngày tạo</h6>
                                        <p class="mb-0">{{ $organization->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="p-2 rounded bg-light">
                                            <i class="fas fa-history text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 fw-bold">Cập nhật lần cuối</h6>
                                        <p class="mb-0">{{ $organization->updated_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Phê duyệt -->
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="approveForm" method="POST"
                action="{{ route('admin.organizations.approve', ['id' => $organization->organization_id]) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xác nhận phê duyệt</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="text-center modal-body">
                        Bạn có chắc chắn muốn phê duyệt sự kiện này?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-success">Xác nhận phê duyệt</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Từ chối -->
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="rejectForm" method="POST"
                action="{{ route('admin.organizations.reject', ['id' => $organization->organization_id]) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xác nhận từ chối</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-3">Vui lòng cung cấp lý do từ chối sự kiện này:</p>
                        <textarea name="note" class="form-control" rows="4" placeholder="Nhập lý do từ chối..." required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-danger">Xác nhận từ chối</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    @if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('
                success ') }}',
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
                text: '{{ session('
                error ') }}',
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