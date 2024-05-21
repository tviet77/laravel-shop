@extends('layouts.admin')

@section('title')
    <title>{{$user->name}} | Thông tin tài khoản</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Cài đặt', 'key' => 'Thông tin tài khoản'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="custom-content-below-tab mb-4" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="true">User profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#avatar" role="tab" aria-controls="avatar" aria-selected="false">Avatar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#change-password" role="tab" aria-controls="change-password" aria-selected="false">Thay đổi mật khẩu</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="custom-content-below-tabContent mt-3">
                                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <form action="{{route('admin.updateProfile', ['id' => $user->id])}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Tên</label>
                                                        <input type="text" class="form-control" placeholder="Nhập tên" name="name" value="{{$user->name}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" placeholder="Nhập email" name="email" value="{{$user->email}}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary float-right" name="btn-add-user">Cập nhật</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="avatar" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                        Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                                    </div>
                                    <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <form action="{{route('admin.updatePassword', ['id' => $user->id])}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Mật khẩu mới</label>
                                                        <input type="text" class="form-control" placeholder="Nhập mật khẩu mới" name="password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nhập lại mật khẩu mới</label>
                                                        <input type="text" class="form-control" placeholder="Nhập lại mật khẩu mới" name="password_confirmation">
                                                        @error('password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <button type="submit" class="btn btn-primary float-right btn-change-password" name="btn-update-password">Cập nhật</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

