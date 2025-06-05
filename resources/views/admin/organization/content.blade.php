@extends('admin.admin')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Organizations</h3>
                                <div class="card-tools">
                                    <form action="{{ url('/admin/organizations/search') }}" method="GET">
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
                                            <th>Fullname</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Representative</th>
                                            <th>Approved</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($organizations as $org)
                                    <tbody>
                                        @foreach ($organizations as $org)
                                            <tr onclick="window.location.href='/admin/organizations/{{ $org['organization_id'] }}'"
                                                style="cursor: pointer;">
                                                <td style="max-width: 10%">{{ $org['organization_id'] }}</td>
                                                <td>{{ $org['username'] }}</td>
                                                <td>{{ $org['email'] }}</td>
                                                <td>{{ $org['address'] }}</td>
                                                <td>{{ $org['representative'] }}</td>
                                                <td>
                                                    @switch($org['approved'])
                                                        @case('pending')
                                                            <span class="badge bg-warning">Chờ duyệt</span>
                                                        @break

                                                        @case('approved')
                                                            <span class="badge bg-success">Đã duyệt</span>
                                                        @break

                                                        @case('rejected')
                                                            <span class="badge bg-danger">Từ chối</span>
                                                        @break

                                                        @default
                                                            <span class="badge bg-secondary">Không rõ</span>
                                                    @endswitch
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="clearfix card-footer">
                                    <div class="float-right">
                                        {{ $organizations->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Flash messages và validation errors --}}
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
