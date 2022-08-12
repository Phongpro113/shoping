

@extends('layouts.admin')

@section('title')
    <title>Sửa</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', [
    'name' => 'category',
    'key' => 'Edit'
])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <form action="{{route("categories.update", ['id' => $data->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">tên danh mục</label>
                                <input type="text" class="form-control" name="name" value="{{$data->name}}" placeholder="Nhập tên danh mục">
                            </div>

                            <label>Chọn danh mục cha</label>
                            <select class="form-control" name="parent_id">
                                <option value="0">Chọn danh mục cha</option>
                                {!! $html !!}}
                            </select>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>

@endsection
