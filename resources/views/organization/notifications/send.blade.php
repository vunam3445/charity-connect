@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Gửi thông báo đến tình nguyện viên trong sự kiện</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('notification.organization.send.event') }}">
        @csrf

        <div class="form-group">
            <label for="event_id">Chọn sự kiện</label>
            <select name="event_id" class="form-control" required>
                @foreach($events as $event)
                <option value="{{ $event->event_id }}">{{ $event->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea name="content" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Gửi thông báo</button>
    </form>
</div>
@endsection