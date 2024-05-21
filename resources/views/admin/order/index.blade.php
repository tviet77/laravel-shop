@extends('layouts.admin')

@section('title')
    <title>Quản lý đơn hàng</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Đơn hàng', 'key' => 'Quản lý'])
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
                                        <th scope="col">Tên khách</th>
                                        <th scope="col">Điện thoại</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Địa chỉ</th>
                                        <th scope="col">Ghi chú</th>
                                        <th scope="col">Chi tiết</th>
                                        <th scope="col">Ngày tạo</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Tuỳ biến</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <th scope="row">{{$order->id}}</th>
                                            <td>{{$order->name}}</td>
                                            <td>{{$order->phone}}</td>
                                            <td>{{$order->email}}</td>
                                            <td>{{$order->address}}</td>
                                            <td>{{$order->note}}</td>
                                            <td><a class="badge bg-primary" href="{{route('order.detail', ['id' => $order->id])}}"> Xem chi tiết</a></td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{!! $order->status === 0 ? '<span class="badge bg-danger">Chưa xác nhận</span>' : '<span class="badge bg-success">Đã xác nhận</span>' !!}</td>

                                            <td>
                                                <a href="#" class="btn btn-danger">Xoá</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

