@extends('layouts.admin')

@section('title')
    <title>Quản lý người dùng</title>
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
                            console.log('Error:', data);
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
        @include('partials.content-header', ['name' => 'Vai trò', 'key' => 'Quản lý'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('roles.create')}}" class="btn btn-primary btn-md mb-3 float-right">Add</a>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tên Role</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <th scope="row">{{$role->id}}</th>
                                            <th>{{$role->name}}</th>
                                            <th>{{$role->display_name}}</th>
                                            <td>
                                                <a href="{{route('roles.edit', ['id' => $role->id])}}" class="btn btn-default">Sửa</a>
                                                <a href="{{route('roles.delete', ['id' => $role->id])}}" data-url="{{route('roles.delete', ['id' => $role->id])}}" class="btn btn-danger btn-action-delete">Xoá</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

