@extends('layouts.admin')

@section('title')
    <title>Role</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/index/index.css') }}">
@endsection
@section('js')
    <script src="{{ asset('admins/slider/delete.js') }}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', [
    'name' => 'Slider',
    'key' => 'list'
    ])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('roles.create') }}" class="btn btn-success float-right m-2">Add role</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên vai trò</th>
                                <th scope="col">Description</th>
                                <th scope="col">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $value)
                                <tr>
                                    <td scope="col">{{$value->id}}</td>
                                    <td scope="col">{{$value->name}}</td>
                                    <td scope="col">{{$value->display_name}}</td>
                                    <td scope="col">
                                        <div>
                                            <a href="{{ route('roles.edit', ['id' => $value->id]) }}" class="btn btn-default">Edit</a>
                                            <a data-url="{{ route('roles.delete', ['id' => $value->id]) }}" class="btn btn-danger delete_slider">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $roles->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
