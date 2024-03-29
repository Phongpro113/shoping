@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admins/category/category.js') }}"> </script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', [
    'name' => 'categories',
    'key' => 'list'
])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('categories.create')}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($category as $value)
                            <tr>
                                <th scope="row">
                                        <p>{{$value->id}}</p>
                                </th>
                                <td>
                                        <p>{{$value->name}}</p>
                                </td>
                                <td>
                                    <a href="{{route('categories.edit', ['id' => $value->id])}}" class="btn btn-default">Edit</a>
                                    <a href=""
                                       data-url="{{ route('categories.delete', ['id' => $value->id]) }}"
                                       class="btn btn-danger action_delete">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $category->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
