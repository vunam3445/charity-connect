@extends('admin.admin')




@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Events</h3>
                                <div class="card-tools">
                                    <form action="{{ url('/admin/events/search') }}" method="GET">
                                        <div class="input-group input-group-sm" style="width: 200px;">
                                            <input type="text" name="keyword" class="float-right form-control"
                                                placeholder="Search" value="{{ request('keyword') }}">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="p-0 card-body table-responsive">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Organizer</th>
                                            <th>Time</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                            <tr onclick="window.location.href='/admin/events/{{ $event['event_id'] }}'"
                                                style="cursor: pointer;">
                                                <td style="max-width: 10%">{{ $event['event_id'] }}</td>
                                                <td>{{ $event['name'] }}</td>
                                                <td>{{ $event['organization']['fullname'] }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($event['start_date'])->format('d/m/Y H:i') }}
                                                    <br>
                                                    -
                                                    {{ \Carbon\Carbon::parse($event['end_date'])->format('d/m/Y H:i') }}
                                                </td>
                                                <td>{{ $event['location'] }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $event['status'] == 'pending' ? 'warning' : 'success' }}">
                                                        {{ ucfirst($event['status']) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="clearfix card-footer">
                                    <div class="float-right">
                                        {{ $events->links() }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Flash messages và validation errors giữ nguyên --}}
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
</div>
=======

        {{-- Flash messages và validation errors giữ nguyên --}}
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
    </div>
@endsection
