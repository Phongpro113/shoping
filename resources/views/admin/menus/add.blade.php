@extends('layouts.admin')

@section('title')
    <title>Thêm Menu</title>
@endsection

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [
    'name' => 'Menu',
    'key' => 'Add'
])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <form action="{{route("menus.store")}}" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Thêm Menu</label>
                      <input type="text" class="form-control" name="name" placeholder="Nhập tên Menu">
                    </div>

                    <label>Menu cha</label>
                    <select class="form-control" name="parent_id">
                        <option value="0">Menu cha</option>
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
