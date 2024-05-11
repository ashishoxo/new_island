<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin User</a>
            </div>
        </div>
        <!-- SidebarSearch Form -->
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
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
   					with font-awesome or any other icon font library -->
                
                <li class="nav-item ">
                    <a href="{{route('admin.dashboard')}}" class="nav-link {{in_array(request()->route()->uri, ['admin/dashboard'])?'active':''}}">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <li class="nav-item {{in_array(request()->route()->uri, ['admin/categories','admin/categories/create','admin/categories/{category}/edit'])?'menu-open':''}}">
                    <a href="#" class="nav-link {{in_array(request()->route()->uri, ['admin/categories','admin/categories/create','admin/categories/{category}/edit'])?'active':''}}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p> Categories <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('categories.index')}}" class="nav-link {{in_array(request()->route()->uri, ['admin/categories','admin/categories/{category}/edit'])?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('categories.create')}}" class="nav-link {{in_array(request()->route()->uri, ['admin/categories/create'])?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Category</p>
                            </a>
                        </li>
                  
                    </ul>
                </li>

                <li class="nav-item {{in_array(request()->route()->uri, ['admin/products','admin/products/create','admin/products/{product}/edit'])?'menu-open':''}}">
                    <a href="#" class="nav-link {{in_array(request()->route()->uri, ['admin/products','admin/products/create','admin/products/{product}/edit'])?'active':''}}" >
                        {{-- <i class=" fas fa-th"></i> --}}
                        <i class="nav-icon fas fa-box"></i>
                        <p> Products <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('products.index')}}" class="nav-link {{in_array(request()->route()->uri, ['admin/products','admin/products/{product}/edit'])?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('products.create')}}" class="nav-link {{in_array(request()->route()->uri, ['admin/products/create'])?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                  
                    </ul>
                </li>
                <li class="nav-item {{in_array(request()->route()->uri, ['admin/users','admin/users/create','admin/users/{user}/edit'])?'menu-open':''}}">
                    <a href="#" class="nav-link {{in_array(request()->route()->uri, ['admin/users','admin/users/create','admin/users/{user}/edit'])?'active':''}}">
                        {{-- <i class=" fas fa-th"></i> --}}
                        <i class="nav-icon fas fa-users"></i>
                        <p> Users <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('users.index')}}" class="nav-link {{in_array(request()->route()->uri, ['admin/users','admin/users/{user}/edit'])?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('users.create')}}" class="nav-link {{in_array(request()->route()->uri, ['admin/users/create'])?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add User</p>
                            </a>
                        </li>
                  
                    </ul>
                </li>
                <li class="nav-item {{in_array(request()->route()->uri, ['admin/admins','admin/admins/create','admin/admins/{admin}/edit'])?'menu-open':''}}">
                    <a href="#" class="nav-link {{in_array(request()->route()->uri, ['admin/admins','admin/admins/create','admin/admins/{admin}/edit'])?'active':''}}">
                        {{-- <i class=" fas fa-th"></i> --}}
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p> Admins <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admins.index')}}" class="nav-link {{in_array(request()->route()->uri, ['admin/admins','admin/admins/{admin}/edit'])?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Admins</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admins.create')}}" class="nav-link {{in_array(request()->route()->uri, ['admin/admins/create'])?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Admin</p>
                            </a>
                        </li>
                  
                    </ul>
                </li>
                <li class="nav-item {{in_array(request()->route()->uri, ['admin/payment-methods','admin/payment-methods/create','admin/payment-methods/{payment_method}/edit'])?'menu-open':''}}">
                    <a href="#" class="nav-link {{in_array(request()->route()->uri, ['admin/payment-methods','admin/payment-methods/create','admin/payment-methods/{payment_method}/edit'])?'active':''}}">
                        {{-- <i class=" fas fa-th"></i> --}}
                        {{-- <i class="nav-icon fas fa-user-tie"></i> --}}
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p> Payment Methods <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('payment-methods.index')}}" class="nav-link {{in_array(request()->route()->uri, ['admin/payment-methods','admin/payment-methods/payment_method}/edit'])?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All payment methods</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('payment-methods.create')}}" class="nav-link {{in_array(request()->route()->uri, ['admin/payment-methods/create'])?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add payment method</p>
                            </a>
                        </li>
                  
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('orders.index')}}" class="nav-link {{request()->route()->uri}} {{in_array(request()->route()->uri, ['admin/orders'])?'active':''}}">
                        {{-- <i class="fas fa-tachometer-alt "></i> --}}
                        <i class="fas fa-box-open nav-icon"></i>
                        <p>Orders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('carts.index')}}" class="nav-link {{request()->route()->uri}} {{in_array(request()->route()->uri, ['admin/carts'])?'active':''}}">

                        <i class="fas fa-shopping-cart nav-icon"></i>
                        <p>Carts</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('content.index')}}" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Content</p>
                    </a>
                </li>
           
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>