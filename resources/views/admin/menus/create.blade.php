@extends('layouts.admin')

@section('title')
    <title>Thêm menu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Menu', 'key' => 'Thêm'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{route('menus.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên menu</label>
                                <input type="text" class="form-control" placeholder="Nhập tên menu" name="menu_name">
                            </div>
                            <div class="form-group">
                                <label >Menu cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0" >Menu cha</option>
                                    {!! $optionMenus !!}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" name="btn-add-menu">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
@endsection

