@extends('layouts.admin')

@section('title')
    <title>Setting</title>
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admins/setting/setting.js') }}"> </script>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/setting/setting.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', [
    'name' => 'Setting',
    'key' => 'add'
])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group float-right">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                Action
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- dropdown menu links -->
                                <li><a href="{{ route('setting.create') . '?type=text' }}">Text</a></li>
                                <li><a href="{{ route('setting.create') . '?type=textarea' }}">Text area</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">config Key</th>
                                <th scope="col">config Value</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $value)
                                <tr>
                                    <th scope="row">
                                        <p>{{ $value->id }}</p>
                                    </th>
                                    <td>
                                        <p>{{ $value->config_key }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $value->config_value }}</p>
                                    </td>
                                    <td>
                                        <a href="{{ route('setting.edit', ['id'=>$value->id]) }}" class="btn btn-default">Edit</a>
                                        <a href=""
                                           data-url="{{ route('setting.delete', ['id'=>$value->id]) }}"
                                           class="btn btn-danger action_delete">Delete</a>
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
