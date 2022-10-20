@extends('layouts.admin')

@section('title')
    <title>Thêm permisson</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', [
    'name' => 'Permisson',
    'key' => 'Add'
])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="{{route("menus.store")}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Permission cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Menu cha</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">
                                            <input type="checkbox"> Danh sách
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">
                                            <input type="checkbox"> Thêm
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">
                                            <input type="checkbox"> Sửa
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">
                                            <input type="checkbox"> Xóa
                                        </label>
                                    </div>
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
