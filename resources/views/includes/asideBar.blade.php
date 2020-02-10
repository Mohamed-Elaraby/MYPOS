@if (Auth::check())
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('dashboard.user.index') }}" class="brand-link">
            <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    @if (Auth::user()->hasPermission('read_users'))
                        <li class="nav-item">
                            <a href="{{ route('dashboard.user.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermission('read_categories'))
                        <li class="nav-item">
                            <a href="{{ route('dashboard.category.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
@endif
