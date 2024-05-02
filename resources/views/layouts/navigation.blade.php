<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('images/user.png') }}" class="img-circle elevation-3" alt="User Image">
        </div>
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-th text-red"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            @can('administration')
            <li class="nav-item has-treeview {{ request()->is('users*') || request()->is('roles*') ?  'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-edit text-green"></i>
                    <p> {{ __('Administration') }} <i class="fas fa-angle-left right text-green"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    @can('administration-user')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link  {{ request()->routeIs('users.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa fa-user-circle text-green"></i>
                            <p> {{ __('Users') }} </p>
                        </a>
                    </li>
                    @endcan
                    @can('administration-role')
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                            <i class="nav-icon fas  fa-universal-access text-green"></i>
                            <p> {{ __('Roles') }} </p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('master-data')
                <li class="nav-item {{ request()->is('items-category*') || request()->is('items*') || request()->is('units*') ?  'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-address-card text-blue"></i>
                        <p> {{ __('Master Data') }} <i class="fas fa-angle-left right text-blue"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
{{--                        @can('master-data-items-category')--}}
                        <li class="nav-item">
                            <a href="{{ route('items-category.index') }}" class="nav-link {{ request()->routeIs('items-category.*') ? 'active' : '' }}">
                                <i class="nav-icon fas  fa-place-of-worship text-blue"></i>
                                <p> {{ __('Item Category') }} </p>
                            </a>
                        </li>
{{--                        @endcan--}}
{{--                        @can('master-data-items')--}}
                        <li class="nav-item">
                            <a href="{{ route('items.index') }}" class="nav-link {{ request()->routeIs('items.*') ? 'active' : '' }}">
                                <i class="nav-icon fas  fa-star text-blue"></i>
                                <p> {{ __('Items') }} </p>
                            </a>
                        </li>
{{--                        @endcan--}}
                        <li class="nav-item">
                            <a href="{{ route('units.index') }}" class="nav-link {{ request()->routeIs('units.*') ? 'active' : '' }}">
                                <i class="nav-icon fas  fa-cube text-blue"></i>
                                <p> {{ __('Units') }} </p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
{{--            @can('master-data')--}}
                <li class="nav-item {{ request()->is('items-category*') || request()->is('items*') || request()->is('units*') ?  'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-store text-yellow"></i>
                        <p> {{ __('Stock Management') }} <i class="fas fa-angle-left right text-yellow"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{--                        @can('master-data-items-category')--}}
                        <li class="nav-item">
                            <a href="{{ route('items-category.index') }}" class="nav-link {{ request()->routeIs('items-category.*') ? 'active' : '' }}">
                                <i class="nav-icon fas  fa-place-of-worship text-blue"></i>
                                <p> {{ __('Item Category') }} </p>
                            </a>
                        </li>
                        {{--                        @endcan--}}
                    </ul>
                </li>
{{--            @endcan--}}

            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="dropdown-item"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="mr-2 fas fa-sign-out-alt text-pink"></i>
                        {{ __('Log Out') }}
                    </a>
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
