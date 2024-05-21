@extends('client.layouts.index')
@section('title')
    <title>{{$product->name}}</title>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#form-add-to-cart').submit(function(e) {
                e.preventDefault(); // Ngăn form submit mặc định
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            Toast.fire({
                                icon: "success",
                                title: "Thêm sản phẩm vào giỏ hàng thành công"
                            });
                        }
                    },
                    error: function(error) {
                        Toast.fire({
                            icon: "error",
                            title: "Thêm sản phẩm vào giỏ hàng thất bại"
                        });
                    }
                });
            });
            // Định nghĩa Toast với SweetAlert2
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
        });

    </script>
@endsection
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{route('home')}}">Trang chủ</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{$product->name}}</strong></div>
                <input type="hidden" name="id" value="{{$product->id}}">
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <form action="{{route('add-to-cart-form')}}" id="form-add-to-cart" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-img-info" id="owl-carousel-product">
                            <img src="{{$product->feature_image_path}}" alt="Image" class="img-fluid">
{{--                            @foreach($productImages as $itemImg)--}}
{{--                                <img src="{{$itemImg->image_path}}" alt="Image" class="img-fluid">--}}
{{--                            @endforeach--}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="text-black">{{$product->name}}</h2>
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <p>{{strip_tags($product->content)}}</p>
                        <p><strong class="text-primary h4">{{number_format($product->price,0,',','.')}} VNĐ</strong></p>
                        <div class="mb-5">
                            <div class="input-group mb-3" style="max-width: 120px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                </div>
                                <input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" name="quantity">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                </div>
                            </div>

                        </div>
                        <input type="submit" value="Thêm vào giỏ hàng" class="buy-now btn btn-sm btn-primary btn-add-to-cart">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Sản phẩm nổi bật</h2>
                </div>
            </div>
            <div class="row">
                @foreach($product_featured as $item)
                    <div class="col-sm-6 col-lg-3 mb-3" data-aos="fade-up">
                        <div class="block-4 text-center border">
                            <figure class="block-4-image">
                                <a href="{{route('product-detail', $item->slug)}}"><img src="{{$item->feature_image_path}}" alt="{{$item->feature_image_path}}" class="img-fluid"></a>
                            </figure>
                            <div class="block-4-text p-4">
                                <h3><a href="{{route('product-detail', $item->slug)}}">{{$item->name}}</a></h3>
                                <p class="text-primary font-weight-bold">{{number_format($item->price,0,',','.')}} VNĐ</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endSection
