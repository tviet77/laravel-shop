@extends('client.layouts.index')
@section('title')
    <title>Giỏ hàng</title>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.btn-delete-cart-item').click(function (event) {
                event.preventDefault();
                const productId = $(this).data('id');
                const elementToRemove = $(this).closest('.cart-item');

                Swal.fire({
                    title: 'Xác nhận xóa',
                    text: "Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('cart.remove', ['id' => ':id']) }}".replace(':id', productId),
                            success: function (data) {
                                if (data.status === 200) {
                                    elementToRemove.remove();
                                    Swal.fire({
                                        title: "Đã xoá!",
                                        text: "Item đã được xoá.",
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
                                console.log('Error:', data);
                            }
                        });
                    }
                });
            });
            $('.btn-update-cart').click(function(event) {
                event.preventDefault();
                var updateUrl = $(this).data('url');
                var cartItems = [];

                $('.cart-item').each(function() {
                    var productId = $(this).find('.btn-delete-cart-item').data('id');
                    var quantity = parseInt($(this).find('.form-control').val(), 10);
                    cartItems.push({
                        id: productId,
                        quantity: quantity
                    });
                });

                $.ajax({
                    url: updateUrl,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        items: cartItems
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Cập nhật giỏ hàng thành công'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Cập nhật giỏ hàng thất bại'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Đã xảy ra lỗi trong quá trình cập nhật'
                        });
                    }
                });
            });
        });
    </script>
@endsection
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{route('home')}}">Home</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Cart</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form class="" method="post" action="{{ route('add-to-cart-form') }}">
                        @csrf
                        <div class="row mb-5">
                            @if($cartEmpty)
                                <div class="alert alert-warning" role="alert">
                                    Giỏ hàng của bạn đang trống!
                                </div>
                            @else
                                @php $total = 0; @endphp
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Tổng cộng</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cart as $id => $item)
                                        <tr class="cart-item">
                                            <td class="product-thumbnail">
                                                <img src="{{ $item['image'] ?? 'images/default.jpg' }}" alt="Image"
                                                     class="img-fluid" style="width: 32px">
                                            </td>
                                            <td class="product-name">
                                                <h2 class="h5 text-black">{{ $item['name'] }}</h2>
                                            </td>
                                            <td>${{ number_format($item['price'], 0, ',', '.') }}</td>
                                            <td>
                                                <div class="input-group mb-3" style="max-width: 120px;">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;
                                                        </button>
                                                    </div>
                                                    <input type="text" class="form-control text-center"
                                                           value="{{ $item['quantity'] }}" placeholder=""
                                                           aria-label="Example text with button addon"
                                                           aria-describedby="button-addon1" min="1" max="100">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</td>
                                            <td><a href="#" class="btn-delete-cart-item btn btn-primary btn-sm"
                                                   data-url="{{ route('cart.remove', ['id' => $id]) }} " data-id="{{$id}}">X</a>
                                            </td>
                                        </tr>
                                        @php $total += $item['price'] * $item['quantity']; @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="text-right">
                                    <h4>Tổng cộng: {{ number_format($total, 0, ',', '.') }} VNĐ</h4>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-5">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <a href="#" class="btn btn-primary btn-sm btn-block btn-update-cart" data-url="{{ route('cart.update') }}" >Cập nhật giỏ hàng</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{route('shop')}}" class="btn btn-outline-primary btn-sm btn-block">Tiếp tục mua hàng</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="text-black h4" for="coupon">Coupon</label>
                                        <p>Enter your coupon code if you have one.</p>
                                    </div>
                                    <div class="col-md-8 mb-3 mb-md-0">
                                        <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-primary btn-sm">Apply Coupon</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pl-5">
                                <div class="row justify-content-end">
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-md-12 text-right border-bottom mb-5">
                                                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <span class="text-black">Subtotal</span>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <strong class="text-black">{{ $cartEmpty ? 0 : number_format($total, 0, ',', '.') }} VNĐ</strong>
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-md-6">
                                                <span class="text-black">Total</span>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <strong class="text-black">{{ $cartEmpty ? 0 : number_format($total, 0, ',', '.') }} VNĐ</strong>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="{{ session()->has('cart') && !empty(session('cart')) ? route('cart.checkOut') : route('cart.index') }}"
                                                   class="btn btn-primary btn-lg py-3 btn-block">
                                                    thanh toán
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
