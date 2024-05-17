@extends('layouts.admin')

@section('title')
    <title>Quản lý Setting</title>
@endsection

@section('js')
    <script src="{{asset('vendor/laravel-filemanager/js/sweetalert2@11.js')}}"></script>
    <script>
        function actionDelete(event) {
            event.preventDefault();
            let urlRequest = $(this).data('url');
            let that = $(this);
            Swal.fire({
                title: "Bạn có chắc muốn xoá item này?",
                text: "Dữ liệu sẽ không thể khôi phục nếu xoá!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Xoá"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        url: urlRequest,
                        success: function (data) {
                            if(data.code == 200){
                                that.parent().parent().remove();
                                Swal.fire({
                                    title: "Đã xoá!",
                                    text: "Item đã được xoá.",
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

                        }
                    });

                }
            });
        }
        $(function(){
            $(document).on('click', '.btn-action-delete', actionDelete)
        })

    </script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Setting', 'key' => 'Quản lý'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Thêm
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('settings.create').'?type=text'}}">Text</a>
                                <a class="dropdown-item" href="{{route('settings.create').'?type=textarea'}}">Textarea</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Config Key</th>
                                        <th scope="col">Config Value</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($adminSettings as $adminSetting)
                                        <tr>
                                            <th scope="row">{{$adminSetting->id}}</th>
                                            <th scope="row">{{$adminSetting->config_key}}</th>
                                            <th scope="row">{{$adminSetting->config_value}}</th>
                                            <td>
                                                <a href="{{route('settings.edit', ['id' => $adminSetting->id]) .'?type='. $adminSetting->type}}" class="btn btn-default">Sửa</a>
                                                <a href="{{route('settings.delete', ['id' => $adminSetting->id])}}" data-url = "{{route('settings.delete', ['id' => $adminSetting->id])}}" class="btn btn-danger btn-action-delete">Xoá</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
{{--                        {{ $sliders->links() }}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

