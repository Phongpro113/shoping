@extends('layouts.admin')

@section('title')
    <title>Thêm sản phẩm</title>
@endsection

@section('css')
    <link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admins/products/add/add.css')}}" rel="stylesheet" />
{{--    <script src="{{asset('admins/products/add/add.js')}}"></script>--}}
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
                        @if(session('message'))
                            <div style="color: red !important;">{{session('message')}}</div>
                        @endif
                        <form action="{{route("product.store")}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Thêm sản phẩm</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên sản phẩm">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init" name="category_id">
                                    <option value=""> Chọn danh mục </option>
                                    {!! $html !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="text" class="form-control" name="price" placeholder="Nhập giá sản phẩm">
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>nhập tags cho sản phẩm</label>
                                <select class="form-control tags_select_choose" name="tags[]" multiple="multiple">
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1 ">chi tiết sản phẩm</label>
                                <textarea class="form-control tinymce_editor_init" rows="3" name="contents"></textarea>
                                @error('contents')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">mã sản phẩm</label>
                                <input type="text" class="form-control" name="user_id" placeholder="Nhập mã sản phẩm">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">ảnh đại diện sản phẩm</label>
                                <input type="file" class="form-control-file" name="feature_image_path" placeholder="chọn ảnh sản phẩm">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">ảnh chi tiết sản phẩm</label>
                                <input type="file" multiple class="form-control-file" name="image_path[]" placeholder="chọn ảnh sản phẩm">
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
    <script src="{{asset('vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('admins/products/add/add.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
{{--    <script src="https://cdn.tiny.cloud/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>--}}

@endsection
