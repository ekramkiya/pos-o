<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('images/asa.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src=" {{asset('images/logo.png')}} " class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->getFullname() }}</a>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if(auth()->user()->role->hasPermission('home view'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role->hasPermission('product view'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('products.index') }}" class="nav-link {{ activeSegment('products') }}">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Products</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role->hasPermission('cart view'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('cart.index') }}" class="nav-link {{ activeSegment('cart') }}">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>Open POS</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role->hasPermission('order view'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('orders.index') }}" class="nav-link {{ activeSegment('orders') }}">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>Orders</p>
                    </a>
                </li>
                @endif
               
               
             
                @if(auth()->user()->role->hasPermission('customer view'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('customers.index') }}" class="nav-link {{ activeSegment('customer') }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Customers</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role->hasPermission('expenses view'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('expenses.index') }}" class="nav-link {{ activeSegment('expenses') }}">
                        <i class="fas fa-money-check-alt"></i>
                        <p>Expenses</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role->hasPermission('purchase view '))
                <li class="nav-item has-treeview">
                    <a href="{{ route('purchase.index') }}" class="nav-link {{ activeSegment('purchase') }}">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <p>Purchase</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role->hasPermission('employe view'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('employe.index') }}" class="nav-link {{ activeSegment('employe') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            <path fill-rule="evenodd"
                                d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                            <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                        </svg>
                        <p>Employe</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role->hasPermission('role view'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('role.index') }}" class="nav-link {{ activeSegment('role') }}">
                        <i class="fas fa-user-tag"></i>
                        <p>Roles</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role->hasPermission('setting view'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('settings.index') }}" class="nav-link {{ activeSegment('settings') }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->role->hasPermission('backup'))
                <li class="nav-item has-treeview">
                    <a href="{{ url('app/smart_pos/2024-03-14-16-56-01.zip') }}" download class="nav-link {{ activeSegment('backup') }}">
                        <i class="fa-solid fa-database"></i>
                        <p>Backup</p>
                    </a>
                </li>
                @endif
                
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit()">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
