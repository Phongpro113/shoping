@extends('layouts.admin')

@section('title')
    <title>Edit Slider</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/add/add.css') }}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', [
    'name' => 'Slider',
    'key' => 'Edit'
])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <form action="{{ route('slider.update', ['id'=>$data->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Slide</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" placeholder="Nhập tên Slide" value="{{ $data->name }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả Slide</label>
                                <textarea name="description"  rows="5" class="form-control
                                @error('description') is-invalid @enderror">
                                  {{ $data->description }}
                                </textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Chọn hình ảnh</label>
                                <input type="file" class="form-control-file" name="image_path">
                                @error('image_path')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <img class="edit_slider" src="{{ $data->image_path }}" alt="" >
                                </div>
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
