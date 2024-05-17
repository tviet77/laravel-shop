@extends('layouts.admin')

@section('title')
    <title>Quản lý menu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Menu', 'key' => 'Quản lý'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('menus.create')}}" class="btn btn-primary btn-md mb-3 float-right">Add</a>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tên menu</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($menus as $menu)
                                        <tr>
                                            <th scope="row">{{$menu->id}}</th>
                                            <td>{{$menu->name}}</td>
                                            <td>{{$menu->slug}}</td>
                                            <td>
                                                <a href="{{route('menus.edit', ['id' => $menu->id])}}" class="btn btn-default">Sửa</a>
                                                <a href="{{route('menus.delete', ['id' => $menu->id])}}" class="btn btn-danger">Xoá</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        {{ $menus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

