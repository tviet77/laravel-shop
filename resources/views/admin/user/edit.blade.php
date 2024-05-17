@extends('layouts.admin')

@section('title')
    <title>Chỉnh sửa người dùng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/build/scss/plugins/_select2.scss')}}">
    <link rel="stylesheet" href="{{asset('admin_extra/product/add/add.css')}}">
    <style>
        .form-group .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #000b16 !important;
        }
    </style>
@endsection

@section('js')
    <script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        $('.role-user').select2({
            tags: true,
            tokenSeparators: [','],
        });
    </script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Slider', 'key' => 'Chỉnh sửa'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{route('users.update', ['id' => $user->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" class="form-control" placeholder="Nhập tên" name="name" value="{{$user->name}}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="Nhập email" name="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password">
                            </div>
                            <div class="form-group">
                                <label>Chọn vai trò</label>
                                <select class="form-control role-user" name="role_id[]" multiple="multiple" style="width: 100%;">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" {{ in_array($role->id, $roleUser) ? 'selected' : '' }}>{{$role->display_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" name="btn-edit-user">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

