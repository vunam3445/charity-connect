@if(!$event->result && $event->status === 'completed')
    <a href="{{ route('results.create', $event->event_id) }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tạo kết quả
    </a>
@endif 