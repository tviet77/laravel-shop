<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <link rel="stylesheet" type="text/css" href="{{asset('admin_auth/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_auth/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_auth/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_auth/css/iofrm-style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_auth/css/iofrm-theme19.css')}}">
</head>
<body>
<div class="form-body without-side">
    <div class="website-logo">
        <a href="#">
            <div class="logo">
                <img class="logo-size" src="{{asset('admin_auth/img/logo-light.svg')}}" alt="">
            </div>
        </a>
    </div>
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <img src="{{asset('admin_auth/img/graphic3.svg')}}" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3 class="text-center">Đăng nhập tài khoản</h3>
                    <form class="form-login-cafe" method="POST" action="{{route('admin.login')}}">
                        @csrf
                        <input class="form-control" type="text" name="username" placeholder="Số điện thoại hoặc địa chỉ E-mail">
                        <input class="form-control" type="password" name="password" placeholder="Mật khẩu">
                        <div class="form-button">
                            <input id="submit" type="submit" class="ibtn text-center" name="btnlogin" value="Đăng nhập"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('admin_auth/js/jquery.min.js')}}"></script>
<script src="{{asset('admin_auth/js/popper.min.js')}}"></script>
<script src="{{asset('admin_auth/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin_auth/js/main.js')}}"></script>
</body>
</html>
