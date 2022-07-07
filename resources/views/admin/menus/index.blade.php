@extends('layouts.admin')

@section('title')
    <title>Menus</title>
@endsection

@section('content')
    <div class="content-wrapper">
    @include('partials.content-header', [
'name' => 'Menus',
'key' => 'list'
])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('menus.create')}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên menu</th>
                                <th scope="col">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $value)
                                    <tr>
                                        <td scope="col">{{$value->id}}</td>
                                        <td scope="col">{{$value->name}}</td>
                                        <td scope="col">
                                            <div>
                                                <a href="{{route('menus.edit', ['id' => $value->id])}}" class="btn btn-default">Edit</a>
                                                <a href="{{route('menus.delete', ['id' => $value->id])}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="col-md-3">
{{--                        {{ $data->links() }}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
