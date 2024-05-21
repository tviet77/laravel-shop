@extends('client.layouts.index')
@section('title')
    <title>Thanh toán</title>
@endsection
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a
                        href="{{route('cart.index')}}">Cart</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Checkout</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="border p-4 rounded" role="alert">
                        Returning customer? <a href="#">Click here</a> to login
                    </div>
                </div>
            </div>
            <form class="form-check-out" action="{{route('cart.checkOut.handle')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-5 mb-md-0">
                        <h2 class="h3 mb-3 text-black">Thông tin giao hàng</h2>
                        <div class="p-3 p-lg-5 border">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black">Họ tên<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_fname" name="name">
                                    @error('name')
                                    <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="c_lname" class="text-black">Điện thoại<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_lname" name="phone">
                                    @error('phone')
                                    <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_companyname" class="text-black">Email</label>
                                    <input type="text" class="form-control" id="c_companyname" name="email">
                                    @error('email')
                                    <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_address" class="text-black">Địa chỉ<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_address" name="address"
                                           placeholder="Nhập địa chỉ gioa hàng">
                                    @error('address')
                                    <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="c_order_notes" class="text-black">Ghi chú</label>
                                <textarea name="note" id="c_order_notes" cols="30" rows="5" class="form-control"
                                          placeholder="Nhập ghi chú..."></textarea>
                                @error('note')
                                <div class="alert alert-danger p-2 mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Đơn hàng</h2>
                                <div class="p-3 p-lg-5 border">
                                    <table class="table site-block-order-table mb-5">
                                        <thead>
                                        <th>Sản phẩm</th>
                                        <th>Tổng</th>
                                        </thead>
                                        <tbody>
                                        @php $total = 0; @endphp
                                        @foreach($cart as $key => $item)
                                            @php
                                                $itemTotal = $item['price'] * $item['quantity'];
                                                $total += $itemTotal;
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{$item['name']}} <strong class="mx-2">x</strong> {{$item['quantity']}}
                                                    <input type="hidden" name="product_id[{{$item['product_id']}}]" value="{{$item['quantity']}}">
                                                </td>
                                                <td>${{number_format($itemTotal, 0, ',', '.')}}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Tổng phụ</strong></td>
                                            <td class="text-black">{{ number_format($total, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Tổng cộng</strong></td>
                                            <td class="text-black font-weight-bold"><strong>{{ number_format($total, 0, ',', '.') }} VNĐ</strong></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div class="form-group">
                                        <input class="btn btn-primary btn-lg py-3 btn-block text-light" type="submit" value="Thanh toán">
                                        </input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    <div class="col-md-6">--}}
{{--                        <div class="row mb-5">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <h2 class="h3 mb-3 text-black">Đơn hàng</h2>--}}
{{--                                <div class="p-3 p-lg-5 border">--}}
{{--                                    <table class="table site-block-order-table mb-5">--}}
{{--                                        <thead>--}}
{{--                                        <th>Sản phẩm</th>--}}
{{--                                        <th>Tổng</th>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @php $total = 0; @endphp--}}
{{--                                        @foreach($cart as $key => $item)--}}
{{--                                            @php--}}
{{--                                                $itemTotal = $item['price'] * $item['quantity'];--}}
{{--                                                $total += $itemTotal;--}}
{{--                                            @endphp--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    {{$item['name']}} <strong class="mx-2">x</strong> {{$item['quantity']}}--}}
{{--                                                    <input type="hidden" name="product_id[{{$item['product_id']}}]" value="{{$item['quantity']}}">--}}
{{--                                                </td>--}}
{{--                                                <td>${{number_format($itemTotal, 0, ',', '.')}}</td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                        <tr>--}}
{{--                                            <td class="text-black font-weight-bold"><strong>Tổng phụ</strong></td>--}}
{{--                                            <td class="text-black">{{ number_format($total, 0, ',', '.') }} VNĐ</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td class="text-black font-weight-bold"><strong>Tổng cộng</strong></td>--}}
{{--                                            <td class="text-black font-weight-bold"><strong>{{ number_format($total, 0, ',', '.') }} VNĐ</strong></td>--}}
{{--                                        </tr>--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}

{{--                                    <div class="form-group">--}}
{{--                                        <input class="btn btn-primary btn-lg py-3 btn-block text-light" type="submit" value="Thanh toán">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>
            </form>

        </div>
    </div>
@endsection
