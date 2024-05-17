@extends('layouts.admin')

@section('title')
    <title>Thêm sản phẩm</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/build/scss/plugins/_select2.scss')}}">
    <link rel="stylesheet" href="{{asset('admin_extra/product/add/add.css')}}">
@endsection

@section('js')
    <script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/2hug2ohdpnoyo1ac7e1fivakzzt1bxm56mdkc8qkbg4vajno/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('admin_extra/product/add/add.js')}}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Sản phẩm', 'key' => 'Thêm'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <form id="form-add-product" action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên sản phẩm"
                                       name="name" value="{{old('name')}}">
                                @error('name')
                                <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" placeholder="Nhập giá" name="price" value="{{old('price')}}">
                                @error('price')
                                <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2-options @error('category_id') is-invalid @enderror" name="product_category_id" style="width: 100%;">
                                    {!! $htmlOption !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Chọn tags cho sản phẩm</label>
                                <select class="select2 select-tags" name="product_tags[]" multiple="multiple" data-placeholder="Lựa chọn tag" style="width: 100%;">
                                    @foreach($tagOption as $tagItem)
                                        <option value="{{$tagItem->name}}">{{$tagItem->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input type="file" class="form-control-file" name="feature_image_path">
                            </div>
                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input type="file" multiple class="form-control-file" name="image_path[]">
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control tinymce_editor" rows="5" name="content">
                                    {{old('content')}}
                                </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary float-right" name="btn-add-product">Thêm mới
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
@endsection

