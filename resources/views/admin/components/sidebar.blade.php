<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="origin-link">
        <img src="{{ asset('admin-assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="origin-image img-circle elevation-3" style="opacity: .8">
        <span class="origin-text font-weight-light">ONLINE SHOP</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Trang chủ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Danh mục</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sub-categories.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Danh mục phụ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>Sản phẩm</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('origins.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>Xuất sứ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('orders.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>Đơn hàng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon  fas fa-users"></i>
                        <p>Tài khoản</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
 </aside>
