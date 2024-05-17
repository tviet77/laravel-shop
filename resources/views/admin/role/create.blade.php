@extends('layouts.admin')

@section('title')
    <title>Thêm Role</title>
@endsection

@section('js')
<script>
    $('.check-box-permission-parent').on('click', function () {
        $(this).parents('.card').find('.check-box-permission-child').prop('checked', $(this).prop('checked'));
    });
    $('.check-box-permission-all').on('click', function () {
        $(this).parents().find('.check-box-permission-child').prop('checked', $(this).prop('checked'));
    })
</script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Role', 'key' => 'Thêm'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{route('roles.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên role</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror " placeholder="Nhập tên role" name="name" value="{{old
                                ('name')}}">
                                @error('name')
                                <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <input type="text" class="form-control @error('display_name') is-invalid @enderror " placeholder="Nhập mô tả role" name="display_name" value="{{old
                                ('display_name')}}">
                                @error('display_name')
                                <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="custom-control">
                                                <input class="form-check-input check-box-permission-all" type="checkbox">
                                                <label class="form-label">Chọn tất cả</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    @foreach($permissionParents as $permission)
                                        <div class="card border-primary">
                                            <div class="card-header">
                                                <div class="custom-control ">
                                                    <div class="form-check">
                                                        <input class="form-check-input check-box-permission-parent" type="checkbox">
                                                        <label>Module {{$permission->name}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @foreach($permission->permissionChild as $permissionChildrent)
                                                <div class="col-3">
                                                    <div class="card-body text-primary">
                                                        <div class="custom-control ">
                                                            <div class="form-check">
                                                                <input class="form-check-input check-box-permission-child" type="checkbox" name="permission_id[]" value="{{$permissionChildrent->id}}">
                                                                <label class="form-check-label">Màn hình {{$permissionChildrent->name}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right" name="btn-add-role">Thêm mới</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>-->
@endsection

