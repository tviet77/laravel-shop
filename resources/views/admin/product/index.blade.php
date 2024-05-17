@extends('layouts.admin')

@section('title')
    <title>Quản lý sản phẩm</title>
@endsection

@section('js')
    <script src="{{asset('vendor/laravel-filemanager/js/sweetalert2@11.js')}}"></script>
    <script>
        function actionDelete(event) {
            event.preventDefault();
            let urlRequest = $(this).data('url');
            let that = $(this);
            Swal.fire({
                title: "Bạn có chắc muốn xoá sản phấm này?",
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
        @include('partials.content-header', ['name' => 'Sản phấm', 'key' => 'Quản lý'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('products.create')}}" class="btn btn-primary btn-md mb-3 float-right">Add</a>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Ảnh đại diện</th>
                                        <th scope="col">Danh mục</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <th scope="row">{{$product->id}}</th>
                                            <td>{{$product->name}}</td>
                                            <td>{{number_format($product->price, 0, ',', '.').' vnđ'}}</td>
                                            <td>
                                                <img src="{{$product->feature_image_path}}" alt="Product 1" class="img-size-32 mr-2">
                                            </td>
                                            <td>{{optional($product->category)->name}}</td>
                                            <td>
                                                <a href="{{route('products.edit', ['id' => $product->id])}}" class="btn btn-primary">Sửa</a>
                                                <a href="{{route('products.delete', ['id' => $product->id])}}"
                                                   data-url="{{route('products.delete', ['id' => $product->id])}}"
                                                   class="btn btn-danger btn-action-delete">Xoá</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        {{ $products->links() }}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

