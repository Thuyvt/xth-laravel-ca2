@extends('admin.layouts.master')

@section('title')
    Danh sách sản phẩm
@endsection

@section('content')
    <a href="{{route('categories.create')}}">
        <button class="btn btn-success">Tạo mới</button>
    </a>
    @if (session('message'))
        <h3>{{session('message')}}</h3>
    @endif
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Tên</th>
            <th>Ảnh</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->cover}}</td>
                    <td>{{$item->is_active}}</td>
                    <td>
                        <a href="{{route('categories.show', $item)}}">
                            <button class="btn btn-success">Xem</button>
                        </a>
                        <a href="{{route('categories.edit', $item)}}">
                            <button class="btn btn-warning">Sửa</button>
                        </a>
                        <form action="{{route('categories.destroy', $item)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
{{--  Phân trang  --}}
{{--    {{$data ->links()}}--}}
@endsection
