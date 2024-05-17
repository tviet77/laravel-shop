@extends('layouts.admin')

@section('title')
    <title>Quản lý slider</title>
@endsection

@section('js')
    <script src="{{asset('vendor/laravel-filemanager/js/sweetalert2@11.js')}}"></script>
    <script>
        function actionDelete(event) {
            event.preventDefault();
            let urlRequest = $(this).data('url');
            let that = $(this);
            Swal.fire({
                title: "Bạn có chắc muốn xoá item này?",
                text: "Dữ liệu sẽ không thể khôi phục nếu xoá!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Xoá"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        url: urlRequest,
                        success: function (data) {
                            if(data.code == 200){
                                that.parent().parent().remove();
                                Swal.fire({
                                    title: "Đã xoá!",
                                    text: "Sản phẩm đã được xoá.",
                                    icon: "success"
                                });
                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: data.message,
                                    icon: "error"
                                })
                            }
                        },
                        error: function (data) {

                        }
                    });

                }
            });
        }
        $(function(){
            $(document).on('click', '.btn-action-delete', actionDelete)
        })

    </script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Slider', 'key' => 'Quản lý'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('sliders.create')}}" class="btn btn-primary btn-md mb-3 float-right">Add</a>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tên Slider</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Nội dung</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sliders as $slider)
                                        <tr>
                                            <th scope="row">{{$slider->id}}</th>
                                            <th scope="row">{{$slider->title}}</th>
                                            <td><img src="{{$slider->image_path}}" alt="Product 1" class="img-size-32 mr-2"></td>
                                            <td>{{$slider->description}}</td>
                                            <td> {{$slider->status == 0 ? "Chưa kích hoạt" : "Đang kích hoạt"}}</td>
                                            <td>
                                                <a href="{{route('sliders.edit', ['id' => $slider->id])}}" class="btn btn-default">Sửa</a>
                                                <a href="{{route('sliders.delete', ['id' => $slider->id])}}" data-url = "{{route('sliders.delete', ['id' => $slider->id])}}" class="btn btn-danger btn-action-delete">Xoá</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        {{ $sliders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

