@extends('layouts.admin')

@section('title')
    <title>Thêm User</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/add/add.css') }}">
    <link href="{{asset('admins/products/add/add.css')}}" rel="stylesheet" />
    <link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', [
    'name' => 'User',
    'key' => 'Add'
])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Thêm User</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" placeholder="Nhập tên User" value="{{ old('name') }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Thêm email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" placeholder="Nhập email" value="{{ old('email') }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Thêm mật khẩu</label>
                                <input type="password" class="form-control @error('name') is-invalid @enderror"
                                       name="password" placeholder="Nhập password" value="{{ old('password') }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Chọn vai trò</label>
                                <select name="role_id[]" class="form-control select2_init" multiple>
                                    @foreach($role as $value)
                                    <option value="{{ $value->id }}">{{ $value->display_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script>
        $(".select2_init").select2({
            placeholder: "Chọn vai trò",
        });
    </script>
@endsection

