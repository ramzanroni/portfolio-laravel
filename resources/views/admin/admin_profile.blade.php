@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Admin Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ !empty($adminData->profile_image) ? url('upload/admin_images/' . $adminData->profile_image) : url('backend/dist/img/user4-128x128.jpg') }}"
                                    alt="User profile picture">
                                {{-- <img class="profile-user-img img-fluid img-circle"
                         src="{{asset('backend/dist/img/user4-128x128.jpg')}}"
                         alt="User profile picture"> --}}
                            </div>

                            <h3 class="profile-username text-center">{{ $adminData->name }}</h3>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-solid fa-signature mr-1"></i> Name</strong>

                            <p class="text-muted">
                                {{ $adminData->name }}
                            </p>

                            <hr>

                            <strong><i class="fas fa-regular fa-envelope"></i> Email</strong>

                            <p class="text-muted">{{ $adminData->email }}</p>

                            <hr>

                            <strong><i class="fas fa-solid fa-signature mr-1"></i> Username</strong>

                            <p class="text-muted">
                                {{ $adminData->username }}
                            </p>

                            <hr>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">

                    <div class="card">

                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings"
                                        data-toggle="tab">Settings</a></li>
                                <li class="nav-item"><a class="nav-link" href="#changePass" data-toggle="tab">Change
                                        Password</a></li>
                            </ul>
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
                                        action="{{ route('admin.update_admin_profile') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $adminData->name }}" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="emain" id="email"
                                                    readonly placeholder="Email" value="{{ $adminData->email }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="username" name="username"
                                                    placeholder="Name" value="{{ $adminData->username }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="customFile" class="col-sm-2 col-form-label">Profile Image</label>

                                            <div class=" col-sm-10">
                                                <input type="file" class="custom-file-input" id="profileImg"
                                                    name="profileImg">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="customFile" class="col-sm-2 col-form-label">Profile Image</label>
                                            <div class="col-sm-10">
                                                <img id="showImg" class="profile-user-img img-fluid img-circle"
                                                    src="{{ !empty($adminData->profile_image) ? url('upload/admin_images/' . $adminData->profile_image) : url('backend/dist/img/user4-128x128.jpg') }}"
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
                                <div class="tab-pane" id="changePass">
                                    <form class="form-horizontal" method="POST"
                                        action="{{ route('admin.update-password') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="oldPass"
                                                    name="oldPass" value="" placeholder="Old Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="newPass"
                                                    name="newPass" placeholder="New Password" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Confirm
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="confirmPass"
                                                    name="confirmPass" placeholder="New Password" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-danger">Change Password</button>
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
            $('#profileImg').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#showImg").attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
