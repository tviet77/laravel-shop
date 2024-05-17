@extends('layouts.admin')

@section('title')
    <title>Thêm Setting</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Setting', 'key' => 'Thêm'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{route('settings.store').'?type='.request()->type}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Config Key</label>
                                <input type="text" class="form-control @error('config_key') is-invalid @enderror " placeholder="Nhập config key" name="config_key"
                                       value="{{old('config_key')}}">
                                @error('config_key')
                                <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            @if(request()->type === 'text')
                                <div class="form-group">
                                    <label>Config Value</label>
                                    <input type="text" class="form-control @error('config_value')
                                    is-invalid @enderror " placeholder="Nhập config value" name="config_value" value="{{old('config_value')}}">
                                    @error('config_value')
                                    <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type === 'textarea')
                                <div class="form-group">
                                    <label>Config Value</label>
                                    <textarea class="form-control @error('config_value')
                                    is-invalid @enderror " placeholder="Nhập config value" name="config_value" rows="5">{{old('config_value')}}</textarea>
                                    @error('config_value')
                                    <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary" name="btn-add-slider">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
@endsection

