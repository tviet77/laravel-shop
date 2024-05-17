@extends('layouts.admin')

@section('title')
    <title>Thêm người dùng</title>
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
    <script src="https://cdn.tiny.cloud/1/2hug2ohdpnoyo1ac7e1fivakzzt1bxm56mdkc8qkbg4vajno/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $('.role-user').select2({
            tags: true,
            tokenSeparators: [','],
        });
    </script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Người dùng', 'key' => 'Thêm'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror " placeholder="Nhập tên" name="name" value="{{old('name')}}">
                                @error('name')
                                <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror " placeholder="Nhập Email" name="email" value="{{old('email')}}">
                                @error('email')
                                <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control @error('title') is-invalid @enderror " placeholder="Nhập mật khẩu" name="password" value="{{old('password')}}">
                                @error('password')
                                <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Chọn vai trò</label>
                                <select class="form-control role-user" name="role_id[]" multiple="multiple" style="width: 100%;">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->display_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary" name="btn-add-user">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
@endsection

