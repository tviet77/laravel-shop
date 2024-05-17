@extends('layouts.admin')

@section('title')
    <title>Chỉnh sửa sản phẩm</title>
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
    <script src="{{asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.css')}}"></script>
    <script src="{{asset('adminlte/build/js/plugins/_image.scss.js')}}"></script>
    <script src="{{asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.js')}}"></script>
    <script>
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({gutterPixels: 3});
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Sản phẩm', 'key' => 'Chỉnh sửa'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <form id="form-add-product" action="{{route('products.update', ['id' => $product->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" value="{{$product->name}}"
                                       name="product_name">
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text" class="form-control" placeholder="Nhập giá" name="product_price" value="{{$product->price}}">
                            </div>
                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2-options" name="product_category_id" style="width: 100%;">
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Chọn tags cho sản phẩm</label>
                                <select class="select2 select-tags" name="product_tags[]" multiple="multiple" data-placeholder="Lựa chọn tag" style="width: 100%;">
                                    @foreach($product->tags as $tagItem)
                                        <option value="{{$tagItem->name}}" selected>{{$tagItem->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input type="file" class="form-control-file" name="feature_image_path">
                                <div class="row filter-container">
                                    <div class="col-md-3 filtr-item" id="show-feature-image">
                                        <a href="{{asset($product->feature_image_path)}}" data-toggle="lightbox" data-title="Ảnh đại diện">
                                            <img src="{{asset($product->feature_image_path)}}" class="img-fluid mb-2" alt="{{asset($product->feature_image_path)}}"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input type="file" multiple class="form-control-file" name="image_path[]">
                                <div class="filter-container p-0 row">
                                    @foreach($product->images as $productImageItem)
                                        <div class="filtr-item col-md-3">
                                            <a href="{{asset($productImageItem->image_path)}}" data-toggle="lightbox" data-title="Ảnh mô tả">
                                                <img src="{{asset($productImageItem->image_path)}}" class="img-fluid mb-2" alt="{{asset($productImageItem->image_name)}}"/>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control tinymce_editor" rows="10" name="product_content">{{$product->content}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary float-right" name="btn-edit-product">Cập nhật
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
@endsection

