<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Cửa hàng thời trang</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Danh mục sản phẩm
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('menus.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>
                            Menus
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('products.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Sản phẩm
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('sliders.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>
                            Slider
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('settings.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-wrench"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Người dùng
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('roles.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Role
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('permissions.create')}}" class="nav-link">
                        <i class="nav-icon fas fa-link"></i>
                        <p>
                            Tạo dữ liệu bảng permission
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
