@extends('layouts.admin')

@section('title')
    <title>Thêm sản phẩm</title>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', [
    'name' => 'product',
    'key' => 'Add'
])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <form action="{{route("product.store")}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Thêm sản phẩm</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="text" class="form-control" name="price" placeholder="Nhập giá sản phẩm">
                            </div>

                            <div class="form-group">
                                <label>nhập tags cho sản phẩm</label>
                                <select class="form-control tags_select_choose" multiple="multiple">
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">chi tiết sản phẩm</label>
                                <textarea class="form-control" rows="3" name="content"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">mã sản phẩm</label>
                                <input type="text" class="form-control" name="user_id" placeholder="Nhập mã sản phẩm">
                            </div>

                            <div class="col-md-10">
                                <label for="exampleInputEmail1">ảnh sản phẩm</label>
                                <input type="file" multiple class="form-control" name="image_path[]" placeholder="chọn ảnh sản phẩm">
                            </div>

                            <label>Chọn danh mục</label>
                            <select class="form-control select2_init" name="parent_id">
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

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function () {
            $(".tags_select_choose").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })
            $(".select2_init").select2({
                placeholder: "Chọn danh mục",
                allowClear: true
            })

        })
    </script>
@endsection
