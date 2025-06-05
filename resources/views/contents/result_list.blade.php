@extends('layouts.app')

@section('title', 'Danh sách kết quả')

@section('content')
    <h2>Kết quả cho chiến dịch:</h2>

    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <ul>
        @foreach ($results as $result)
    <li>
        {{ $result->content }}
        <form action="{{ route('result.destroy', $result->result_id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa kết quả này?')">Xóa</button>
        </form>
        <a href="{{ route('result.edit', $result->result_id) }}">Sửa</a>
    </li>
@endforeach
    </ul>
@endsection