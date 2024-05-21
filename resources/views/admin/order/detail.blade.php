@extends('layouts.admin')

@section('title')
    <title>Chi tiết đơn hàng</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Đơn hàng', 'key' => 'Chi tiết'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Tổng tiền</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <th scope="row">{{$product->id}}</th>
                                            <td><img class="img-size-32 mr-2" src="{{$product->feature_image_path}}" alt="" srcset=""></td>
                                            <td>{{$product->name}}</td>
                                            <td>{{number_format($product->price, 0, ',', '.')}}</td>
                                            <td>{{$order_detail[$product->id]}}</td>
                                            <td>{{number_format($product->price * $order_detail[$product->id], 0, ',', '.')}} VNĐ</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

