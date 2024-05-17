@extends('layouts.admin')

@section('title')
    <title>Chỉnh sửa slider</title>
@endsection

@section('js')
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
        @include('partials.content-header', ['name' => 'Slider', 'key' => 'Chỉnh sửa'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{route('sliders.update', ['id' => $slider->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên slider</label>
                                <input type="text" class="form-control" placeholder="Nhập tên slider" name="title" value="{{$slider->title}}">
                            </div>
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input type="file" class="form-control-file" name="image_path">
                                <div class="row filter-container">
                                    <div class="col-md-3 filtr-item" id="show-feature-image">
                                        <a href="{{asset($slider->image_path)}}" data-toggle="lightbox" data-title="Ảnh đại diện">
                                            <img src="{{asset($slider->image_path)}}" class="img-fluid mb-2" alt="{{asset($slider->image_path)}}"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select class="form-control" name="status">
                                    <option value="0" {{$slider->status == 0 ? "selected" : ""}}>Chưa kích hoạt</option>
                                    <option value="1" {{$slider->status == 1 ? "selected" : ""}}>Kích hoạt</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control" rows="5" name="description">{{$slider->description}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="btn-edit-slider">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

