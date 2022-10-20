@extends('layouts.admin')

@section('title')
    <title>Sửa role</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/add/add.css') }}">
    <style>
        .card-header {
            background-color: #0f6674;
        }
    </style>
@endsection
@section('js')
    <script>
        $('.checkbox_wrapper').on('click', function () {
            $(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
        })
    </script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', [
    'name' => 'Role',
    'key' => 'Edit'
])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{ route('roles.update', ['id' => $role->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên vai trò</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ $role->name }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả vai trò</label>
                                <textarea
                                    name="display_name" rows="4" class="form-control">
                                    {{ $role->display_name }}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                @foreach($permissionParent as $value)
                                    <div class="card border-primary mb-3 col-md-12" style="padding: unset">
                                        <div class="card-header">
                                            <label for="">
                                                <input type="checkbox" value="" class="checkbox_wrapper">
                                            </label>
                                            Module {{ $value->name }}
                                        </div>
                                        <div class="row">
                                            @foreach($value->permissionChildrent as $permissionChildrent)
                                                <div class="card-body text-primary col-md-3">
                                                    <h5 class="card-title">
                                                        <label for="">
                                                            <input type="checkbox" name="permission_id[]"
                                                               {{ $permissionChecked->contains('id', $permissionChildrent->id) ? 'checked':'' }}
                                                               value="{{ $permissionChildrent->id }}"
                                                               class="checkbox_childrent">
                                                        </label>
                                                        {{ $permissionChildrent->name }}
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
