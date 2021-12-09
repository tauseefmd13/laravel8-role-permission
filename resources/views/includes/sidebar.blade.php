<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ set_active('admin/dashboard') }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    {{ __('Dashboard') }}
                  </p>
                </a>
            </li>

            @can('user_management_access')
            <li class="nav-item {{ set_active(['admin/permissions*','admin/roles*','admin/users*'],'menu-open') }}">
              <a href="javascript:void(0)" class="nav-link {{ set_active(['admin/permissions*','admin/roles*','admin/users*']) }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  {{ __('User Management') }}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('permission_access')
                <li class="nav-item">
                  <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ set_active(['admin/permissions*']) }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('Permissions') }}</p>
                  </a>
                </li>
                @endcan
                @can('role_access')
                <li class="nav-item">
                  <a href="{{ route('admin.roles.index') }}" class="nav-link {{ set_active(['admin/roles*']) }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('Roles') }}</p>
                  </a>
                </li>
                @endcan
                @can('user_access')
                <li class="nav-item">
                  <a href="{{ route('admin.users.index') }}" class="nav-link {{ set_active(['admin/users*']) }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ __('Users') }}</p>
                  </a>
                </li>
                @endcan
              </ul>
            </li>
            @endcan

            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                    {{ __('Logout') }}
                    </p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>