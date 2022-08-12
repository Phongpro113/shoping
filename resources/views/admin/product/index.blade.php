@extends('layouts.admin')

@section('title')
    <title>Sản phẩm </title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset("admins/products/index/list.css")}}">
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', [
    'name' => 'products',
    'key' => 'list'
])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('product.create')}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $value)
                                <tr>
                                    <th scope="row">
                                        <p>{{$value->id}}</p>
                                    </th>
                                    <td>
                                        <p>{{$value->name}}</p>
                                    </td>
                                    <td>
                                        <p>{{number_format($value->price)}}</p>
                                    </td>
                                    <td>
                                            <p><img class="product_image_150_100" src="{{$value->feature_image_path}}" alt="hinh anh"></p>
                                    </td>
                                    <td>
                                        <p>
                                            @if(!empty($value->category->name))
                                                {{$value->category->name}}
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        <a href="{{route('product.edit', ['id' => $value->id])}}" class="btn btn-default">Edit</a>
                                        <a href="{{route('product.delete', ['id' => $value->id])}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $data->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

