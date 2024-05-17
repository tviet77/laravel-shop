@extends('layouts.admin')

@section('title')
    <title>Chỉnh sửa danh mục</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Danh mục', 'key' => 'Chỉnh sửa'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{route('categories.update', ['id' => $category->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text" class="form-control" placeholder="Nhập tên danh mục" name="category_name" value="{{$category->name}}">
                                <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label >Danh mục cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0" >Danh mục cha</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" name="btn-edit-category">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

