@extends('layouts.admin')

@section('title')
    <title>Thêm Permission</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Permission', 'key' => 'Thêm'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{route('permissions.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Chọn tên name</label>
                                <select class="form-control" name="module_parent">
                                    <option value="">-- Chọn --</option>
                                    @foreach(config('permissions.table_module') as $key => $module)
                                        <option value="{{$key}}">{{ $module }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="role">
                                    <div class="row">
                                        @foreach(config('permissions.module_children') as $key => $moduleChild)
                                            <div class="col-md-3">
                                                <input value="{{ $key }}" type="checkbox" name="module_children[]" id="">
                                                <label>{{ $moduleChild }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right" name="btn-add-permission">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
@endsection

