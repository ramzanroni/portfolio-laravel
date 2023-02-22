@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Home Page Slider</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Home Page Slider</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">

                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                            
                        </div><!-- /.card-header -->
                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-danger">{{ $error }}</p>
                            @endforeach
                        @endif
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">
                                    <form class="form-horizontal" method="POST"
                                        action="{{route('update.slider')}}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value="{{ $homeslide->id }}">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Slider Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="title" name="title"
                                                    value="{{ $homeslide->title}}" placeholder="Slider Title">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Sort Description</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="sort_desc" id="sort_desc"  rows="3" placeholder="Enter Sort Description About Your Slider">{{ $homeslide->sort_description}}</textarea>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Video URL</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="video_url" name="video_url"
                                                    placeholder="Enter Video URL" value="{{ $homeslide->video_url }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="customFile" class="col-sm-2 col-form-label">Slider Image</label>

                                            <div class=" col-sm-10">
                                                <input type="file" class="custom-file-input" id="slider_img"
                                                    name="slider_img">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="customFile" class="col-sm-2 col-form-label">Slider Image</label>
                                            <div class="col-sm-10">
                                                <img id="showImg" class="profile-user-img img-fluid img-circle"
                                                    src="{{ !empty($homeslide->slider_img) ? url( $homeslide->slider_img) : url('backend/dist/img/No_Image_Available.jpg') }}"
                                                    alt="User profile picture">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-danger">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#slider_img').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#showImg").attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
