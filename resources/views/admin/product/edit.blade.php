@extends('layouts.admin')

@section('title')
    <title>Sửa sản phẩm</title>
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
    'key' => 'Edit'
])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <form action="{{route("product.update", ['id'=>$product->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">tên sản phẩm</label>
                                <input type="text" class="form-control" name="name" value="{{$product->name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="text" class="form-control" name="price" value="{{$product->price}}"
                                       placeholder="Nhập giá sản phẩm">
                            </div>

                            <div class="form-group">
                                <label>nhập tags cho sản phẩm</label>
                                <select class="form-control tags_select_choose" name="tags[]" multiple="multiple">
                                    @foreach($product->tags as $value)
                                        <option value="{{ $value->name }}" selected>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1 ">chi tiết sản phẩm</label>
                                <textarea class="form-control tinymce_editor_init" rows="3" name="contents"
                                          value="{{$product->content}}"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">mã sản phẩm</label>
                                <input type="text" class="form-control" name="user_id" placeholder="Nhập mã sản phẩm"
                                value="{{$product->user_id}}"
                                >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">ảnh đại diện sản phẩm</label>
                                <input type="file" multiple class="form-control-file" name="feature_image_path"
                                       placeholder="chọn ảnh sản phẩm">
                                <div class="col-md-4 feature_image_container">
                                    <img class="feature_image" src="{{$product->feature_image_path}}" alt="avt">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">ảnh chi tiết sản phẩm</label>
                                <input type="file" multiple class="form-control-file" name="image_path[]"
                                       placeholder="chọn ảnh sản phẩm" >
                                <div class="col-md-12 container_image_detail ">
                                    @foreach($product->productImage as $value)
                                    <div class="col-md-3">
                                        <img class="image_detail" src="{{ $value->image_path }}" alt="">
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <label>Chọn danh mục</label>
                            <select class="form-control select2_init" name="category_id">
                                {!! $category !!}
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
    <script src="{{asset('vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('admins/products/add/add.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
{{--    <script src="https://cdn.tiny.cloud/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>--}}

@endsection
