@extends('layouts.admin')

@section('title')
    <title>Chỉnh sửa menu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Danh mục', 'key' => 'Chỉnh sửa'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{route('menus.update', ['id' => $menu->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên menu</label>
                                <input type="text" class="form-control" placeholder="Nhập tên danh mục" name="menu_name" value="{{$menu->name}}">
                            </div>
                            <div class="form-group">
                                <label>Menu cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0" >Menu cha</option>
                                    {!! $optionMenus !!}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" name="btn-edit-menu">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

