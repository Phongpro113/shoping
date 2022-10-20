@extends('layouts.admin')

@section('title')
    <title>Slider</title>
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
                        <a href="{{ route('slider.create') }}" class="btn btn-success float-right m-2">Add Slider</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Slider</th>
                                <th scope="col">Description</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($slider as $value)
                                <tr>
                                    <td scope="col">{{$value->id}}</td>
                                    <td scope="col">{{$value->name}}</td>
                                    <td scope="col">{{$value->description}}</td>
                                    <td><img class="image" src="{{ $value->image_path }}"></td>
                                    <td scope="col">
                                        <div>
                                            <a href="{{ route('slider.edit', ['id' => $value->id]) }}" class="btn btn-default">Edit</a>
                                            <a data-url="{{ route('slider.delete', ['id' => $value->id]) }}" class="btn btn-danger delete_slider">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $slider->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
