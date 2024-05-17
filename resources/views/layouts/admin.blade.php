<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href=" {{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
    @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('partials.header')

    @include('partials.sliderbar')

    @yield('content')

    @include('partials.footer')
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnShowInfo = document.querySelector('.btn-show-info');
        const dropdownMenu = btnShowInfo.nextElementSibling;

        btnShowInfo.addEventListener('click', function(event) {
            event.preventDefault();
            dropdownMenu.classList.toggle('show');
        });

        document.addEventListener('click', function(event) {
            if (!event.target.closest('.btn-show-info')) {
                dropdownMenu.classList.remove('show');
            }
        });
    });
</script>
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>

@yield('js')
</body>
</html>
