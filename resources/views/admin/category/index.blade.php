@extends('layouts.admin')

@section('title')
    <title>Quản lý danh mục</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Danh mục', 'key' => 'Quản lý'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('categories.create')}}" class="btn btn-primary btn-md mb-3 float-right">Add</a>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên danh mục</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <th scope="row">{{$category->id}}</th>
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->slug}}</td>
                                            <td>
                                                <a href="{{route('categories.edit', ['id' => $category->id])}}" class="btn btn-default">Sửa</a>
                                                <a href="{{route('categories.delete', ['id' => $category->id])}}" class="btn btn-danger">Xoá</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

