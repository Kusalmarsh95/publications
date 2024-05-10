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
                <li class="nav-item {{ request()->is('items-category*') || request()->is('items*') || request()->is('units*') || request()->is('services-category*') || request()->is('services*') ?  'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-address-card text-blue"></i>
                        <p> {{ __('Master Data') }} <i class="fas fa-angle-left right text-blue"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('master-data-items-category')
                        <li class="nav-item">
                            <a href="{{ route('items-category.index') }}" class="nav-link {{ request()->routeIs('items-category.*') ? 'active' : '' }}">
                                <i class="nav-icon fas  fa-building text-blue"></i>
                                <p> {{ __('Item Category') }} </p>
                            </a>
                        </li>
                        @endcan
                        @can('master-data-items')
                        <li class="nav-item">
                            <a href="{{ route('items.index') }}" class="nav-link {{ request()->routeIs('items.*') ? 'active' : '' }}">
                                <i class="nav-icon fas  fa-star text-blue"></i>
                                <p> {{ __('Items') }} </p>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{ route('units.index') }}" class="nav-link {{ request()->routeIs('units.*') ? 'active' : '' }}">
                                <i class="nav-icon fas  fa-cube text-blue"></i>
                                <p> {{ __('Units') }} </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('services-category.index') }}" class="nav-link {{ request()->routeIs('services-category.*') ? 'active' : '' }}">
                                <i class="nav-icon fas  fa-users-gear text-blue"></i>
                                <p> {{ __('Service Category') }} </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">
                                <i class="nav-icon fas  fa-pen text-blue"></i>
                                <p> {{ __('Services') }} </p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('stock-management')
                <li class="nav-item {{ request()->is('suppliers*') || request()->routeIs('workers.*') || request()->routeIs('purchases.*') ?  'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-store text-yellow"></i>
                        <p> {{ __('Stock Management') }} <i class="fas fa-angle-left right text-yellow"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('stock-management-suppliers')
                        <li class="nav-item">
                            <a href="{{ route('suppliers.index') }}" class="nav-link {{ request()->routeIs('suppliers.*')  ? 'active' : '' }}">
                                <i class="nav-icon fas  fa-users text-yellow"></i>
                                <p> {{ __('Suppliers') }} </p>
                            </a>
                        </li>
                        @endcan
                        @can('stock-management-workers')
                        <li class="nav-item">
                            <a href="{{ route('workers.index') }}" class="nav-link {{ request()->routeIs('workers.*')  ? 'active' : '' }}">
                                <i class="nav-icon fas  fa-user-nurse text-yellow"></i>
                                <p> {{ __('Workers') }} </p>
                            </a>
                        </li>
                        @endcan
                        @can('stock-management-purchase')
                        <li class="nav-item">
                            <a href="{{ route('purchases.index') }}" class="nav-link {{ request()->routeIs('purchases.*') ? 'active' : '' }}">
                                <i class="nav-icon fas  fa-shopping-bag text-yellow"></i>
                                <p> {{ __('Purchases') }} </p>
                            </a>
                        </li>
                        @endcan
                        @can('stock-management-issues')
                        <li class="nav-item">
                            <a href="{{ route('issues.index') }}" class="nav-link {{ request()->routeIs('issues.*') ? 'active' : '' }}">
                                <i class="nav-icon fas  fa-circle-arrow-right text-yellow"></i>
                                <p> {{ __('Issues') }} </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            {{--            @can('master-data')--}}
                <li class="nav-item {{ request()->is('customers*') || request()->is('orders*') ?  'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-print text-orange"></i>
                        <p> {{ __('Publication Management') }} <i class="fas fa-angle-left right text-orange"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{--                        @can('master-data-items-category')--}}
                        <li class="nav-item">
                            <a href="{{ route('customers.index') }}" class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                                <i class="nav-icon fas  fa-users text-orange"></i>
                                <p> {{ __('Customers') }} </p>
                            </a>
                        </li>
                        {{--                        @endcan--}}
                        {{--                        @can('master-data-items-category')--}}
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}" class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                                <i class="nav-icon fas  fa-arrow-up-wide-short text-orange"></i>
                                <p> {{ __('Orders') }} </p>
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
