<aside class="main-sidebar sidebar-dark-primary elevation-4">

<!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('panel/dist/img/default-150x150.png')}}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            @auth
                <div class="info">
                    @if(auth()->check() && !auth()->user()->is_admin)
                        <a href="" class="d-block">{{auth()->user()->name}}</a>
                    @else
                        <a href="#" class="d-block">{{auth()->user()->name}}</a>
                    @endif
                </div>
            @endauth
        </div>

    <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{route('admin.admins.index')}}"
                       class="nav-link @if(($nav_link ?? '')  == 'admins') active @endif">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>Admins</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.roles.index')}}"
                       class="nav-link @if(($nav_link ?? '')  == 'roles') active @endif">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Roles</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
