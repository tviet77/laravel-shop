@extends('layouts.admin')

@section('title')
    <title>Thêm slider</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Slider', 'key' => 'Thêm'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{route('sliders.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên slider</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror " placeholder="Nhập tên slider" name="title" value="{{old
                                ('title')}}">
                                @error('title')
                                <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image_path">
                                @error('image')
                                <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" rows="5" name="description">{{old('description')}}</textarea>
                                @error('description')
                                <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary" name="btn-add-slider">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
@endsection

