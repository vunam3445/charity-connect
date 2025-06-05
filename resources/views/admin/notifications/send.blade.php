@extends('admin.admin')

@section('title', 'Gửi thông báo (Admin)')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h2 class="mb-4">📢 Gửi thông báo với tư cách <strong>Admin</strong></h2>

            {{-- Thông báo thành công/thất bại --}}
            @if(session('status'))
            <div class="alert alert-{{ session('status') === 'success' ? 'success' : 'danger' }}">
                {{ session('message') }}
            </div>
            @endif

            {{-- Hiển thị lỗi validate --}}
            @if($errors->any())
            <div class="alert alert-danger">
                <strong>Đã xảy ra lỗi:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('notification.admin.send') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="title" class="fw-bold">Tiêu đề</label>
                    <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}" placeholder="Nhập tiêu đề thông báo">
                </div>

                <div class="form-group mb-3">
                    <label for="content" class="fw-bold">Nội dung</label>
                    <textarea name="content" id="content" class="form-control" rows="4" required placeholder="Nhập nội dung...">{{ old('content') }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="target" class="fw-bold">Gửi tới:</label>
                    <select name="target" id="target" class="form-select" required>
                        <option value="">-- Chọn đối tượng --</option>
                        <optgroup label="🔁 Gửi hàng loạt">
                            <option value="all" {{ old('target') == 'all' ? 'selected' : '' }}>Toàn hệ thống</option>
                            <option value="all_organizations" {{ old('target') == 'all_organizations' ? 'selected' : '' }}>Toàn bộ tổ chức</option>
                        </optgroup>
                        <optgroup label="🎯 Gửi riêng">
                            <option value="one_organization" {{ old('target') == 'one_organization' ? 'selected' : '' }}>Tổ chức cụ thể</option>
                            <option value="event_volunteers" {{ old('target') == 'event_volunteers' ? 'selected' : '' }}>Tình nguyện viên trong sự kiện</option>
                        </optgroup>
                    </select>
                </div>

                <div class="form-group mb-3" id="target-id-group" style="display: none;">
                    <label for="target_id" class="fw-bold">Chọn tổ chức / sự kiện</label>
                    <select name="target_id" id="target_id" class="form-select">
                        <option value="">-- Chọn --</option>
                        @foreach($organizations as $org)
                        <option value="{{ $org->organization_id }}" data-type="organization"
                            {{ old('target_id') == $org->organization_id ? 'selected' : '' }}>
                            {{ $org->username }}
                        </option>
                        @endforeach
                        @foreach($events as $event)
                        <option value="{{ $event->event_id }}" data-type="event"
                            {{ old('target_id') == $event->event_id ? 'selected' : '' }}>
                            {{ $event->name }}
                        </option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Chọn tên tổ chức hoặc sự kiện tương ứng.</small>
                </div>

                <button type="submit" class="btn btn-success px-4">Gửi thông báo</button>
            </form>
        </div>
    </div>
</div>


{{-- JavaScript ẩn/hiện phần chọn ID --}}
<script>
    const targetSelect = document.getElementById('target');
    const targetIdGroup = document.getElementById('target-id-group');
    const targetIdSelect = document.getElementById('target_id');

    function updateTargetOptions() {
        const targetValue = targetSelect.value;

        if (targetValue === 'one_organization') {
            targetIdGroup.style.display = 'block';
            Array.from(targetIdSelect.options).forEach(opt => {
                opt.style.display = opt.dataset.type === 'organization' ? 'block' : 'none';
            });
        } else if (targetValue === 'event_volunteers') {
            targetIdGroup.style.display = 'block';
            Array.from(targetIdSelect.options).forEach(opt => {
                opt.style.display = opt.dataset.type === 'event' ? 'block' : 'none';
            });
        } else {
            targetIdGroup.style.display = 'none';
        }
    }

    targetSelect.addEventListener('change', updateTargetOptions);
    document.addEventListener('DOMContentLoaded', updateTargetOptions);
</script>
@endsection