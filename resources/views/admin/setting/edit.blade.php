@extends('layouts.admin')

@section('title')
    <title>Chỉnh sửa setting</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Setting', 'key' => 'Chỉnh sửa'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{route('settings.update', ['id' => $adminSetting->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Config key</label>
                                <input type="text" class="form-control" placeholder="Nhập tên slider" name="config_key" value="{{$adminSetting->config_key}}">
                            </div>
                            @if(request()->type === 'text')
                                <div class="form-group">
                                    <label>Config Value</label>
                                    <input type="text" class="form-control @error('config_value')
                                    is-invalid @enderror " placeholder="Nhập config value" name="config_value" value="{{$adminSetting->config_value}}">
                                    @error('config_value')
                                    <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type === 'textarea')
                                <div class="form-group">
                                    <label>Config Value</label>
                                    <textarea class="form-control @error('config_value')
                                    is-invalid @enderror " placeholder="Nhập config value" name="config_value" rows="5">{{$adminSetting->config_value}}</textarea>
                                    @error('config_value')
                                    <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary" name="btn-edit-slider">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

