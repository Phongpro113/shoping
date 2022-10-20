@extends('layouts.admin')

@section('title')
    <title>Thêm Setting</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', [
    'name' => 'Setting',
    'key' => 'Add'
])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <form action="{{ route('setting.store') . '?type=' . request()->type }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Config key</label>
                                <input type="text" class="form-control"
                                       name="config_key" placeholder="Nhập Config key" value="{{ old('name') }}">
                            </div>
                            @if(request()->type === 'text')
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Config value</label>
                                    <input type="text" class="form-control"
                                           name="config_value" placeholder="Nhập Config value" value="{{ old('name') }}">
                                </div>
                            @elseif(request()->type === 'textarea')
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Config value</label>
                                    <textarea name="config_value" rows="5" class="form-control">

                                    </textarea>
                                </div>
                            @endif


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
