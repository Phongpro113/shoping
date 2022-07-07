@extends('layouts.admin')

@section('title')
    <title>Thêm danh mục</title>
@endsection

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [
    'name' => 'category',
    'key' => 'Add'
])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <form action="{{route("categories.store")}}" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Thêm danh mục</label>
                      <input type="text" class="form-control" name="name" placeholder="Nhập tên danh mục">
                    </div>

                    <label>Chọn danh mục cha</label>
                    <select class="form-control" name="parent_id">
                        <option value="0">Chọn danh mục cha</option>
                        {!! $html !!}
                    </select>

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
