<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if(Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" class="user-image" alt="{{ Auth::user()->name }}">
                @else
                    <img src="/backend/dist/img/logo-admin.jpg" class="user-image" alt="User Image">
                @endif
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="{{ route('admin.home') }}"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> --}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HỆ THỐNG BÁN HÀNG</li>
            <li class="{{ request()->is('admin') ? 'active' : '' }}">
                <a href="{{ route('admin.home') }}">
                    <i class="fa fa-dashboard"></i> <span>Trang Chủ</span>

                </a>
            </li>

            @can('view' , App\Model\Order::class)
            <li class="{{ request()->is('admin/order*') ? 'active' : '' }}">
                <a href="{{ route('order.index') }}">
                    <i class="fa fa-shopping-cart"></i> <span>QL Đơn Hàng</span>
                </a>
            </li>
            @endcan

            @can('view' , App\Model\Category::class)
            <li class="{{ request()->is('admin/danh-muc*') ? 'active' : '' }}">
                <a href="{{ route('danh-muc.index') }}">
                    <i class="fa fa-sticky-note-o"></i> <span>QL Danh Mục</span>

                </a>
            </li>
            @endcan

            @can('view' , App\Model\Product::class)
            <li class="{{ request()->is('admin/san-pham*') ? 'active' : '' }}">
                <a href="{{ route('san-pham.index') }}">
                    <i class="fa  fa-clone"></i> <span>QL Sản Phẩm</span>

                </a>
            </li>
            @endcan

            @can('view' , App\Model\Coupon::class)
            <li class="{{ request()->is('admin/khuyen-mai*') ? 'active' : '' }}">
                <a href="{{ route('khuyen-mai.index') }}">
                    <i class="fa fa-th"></i> <span>QL Khuyến Mại</span>

                </a>
            </li>
            @endcan

            @can('view' , App\Model\Article::class)
            <li class="{{ request()->is('admin/tin-tuc*') ? 'active' : '' }}">
                <a href="{{ route('tin-tuc.index') }}">
                    <i class="fa fa-newspaper-o"></i> <span>QL Tin Tức</span>

                </a>
            </li>
            @endcan

            @can('view' , App\Model\Vendor::class)
            <li class="{{ request()->is('admin/nha-cung-cap*') ? 'active' : '' }}">
                <a href="{{ route('nha-cung-cap.index') }}">
                    <i class="fa fa-th"></i> <span>QL Nhà Cung Cấp</span>

                </a>
            </li>
            @endcan

            @can('view' , App\Model\Article::class)
            <li class="{{ request()->is('admin/thuong-hieu*') ? 'active' : '' }}">
                <a href="{{ route('thuong-hieu.index') }}">
                    <i class="fa fa-th"></i> <span>QL Thương Hiệu</span>

                </a>
            </li>
            @endcan
            @can('view' , App\Model\Banner::class)
            <li  class="{{ request()->is('admin/banner*') ? 'active' : '' }}">
                <a href="{{ route('banner.index') }}">
                    <i class="fa fa-image"></i> <span>QL Banner</span>

                </a>
            </li>
            @endcan

            @can('view' , App\User::class)
            <li class="{{ request()->is('admin/tai-khoan*') ? 'active' : '' }}">
                <a href="{{ route('tai-khoan.index') }}">
                    <i class="fa fa-users"></i> <span>QL Tài Khoản</span>

                </a>
            </li>
            @endcan

            <li  class="{{ request()->is('admin/lien-he*') ? 'active' : '' }}">
                <a href="{{ route('lien-he.index') }}">
                    <i class="fa fa-expeditedssl"></i> <span>QL Liên Hệ</span>

                </a>
            </li>

            @can('view' , App\Role::class)
            <li  class="{{ request()->is('admin/roles*') ? 'active' : '' }}">
                <a href="{{ route('roles.index') }}">
                    <i class="fa fa-expeditedssl"></i> <span>QL Quyền Admin</span>
                </a>
            </li>
            @endcan





            @can('setting-website')
            <li  class="{{ request()->is('admin/setting') ? 'active' : '' }}">
                <a href="{{ route('setting.index') }}">
                    <i class="fa fa-fw fa-gears"></i> <span>Cấu Hình WebSite</span>

                </a>
            </li>
            @endcan

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
