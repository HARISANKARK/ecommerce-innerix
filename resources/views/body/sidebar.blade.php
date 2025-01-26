<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a  class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{env("APP_NAME")}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <li class="nav-item">
                    <a href="{{url('/home')}}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                    <i class="nav-icon fa fa-tachometer"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                </li>
                @canany(['view', 'create'])
                @can('categories')
                <li class="nav-item {{ Request::is('categories*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                      <p>
                        Categories
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('create')
                        <li class="nav-item">
                            <a href="{{route('categories.create')}}" class="nav-link {{ Request::is('categories/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Add
                            </p>
                            </a>
                        </li>
                        @endcan
                        @can('view')
                        <li class="nav-item">
                            <a href="{{route('categories.index')}}" class="nav-link {{ Request::is('categories') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                View
                            </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('products')
                <li class="nav-item {{ Request::is('products*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                      <p>
                        Products
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('create')
                        <li class="nav-item">
                            <a href="{{route('products.create')}}" class="nav-link {{ Request::is('products/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Add
                            </p>
                            </a>
                        </li>
                        @endcan
                        @can('view')
                        <li class="nav-item">
                            <a href="{{route('products.index')}}" class="nav-link {{ Request::is('products') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                View
                            </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('orders')
                <li class="nav-item {{ Request::is('orders*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                      <p>
                        Orders
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- @can('create')
                        <li class="nav-item">
                            <a href="{{route('orders.create')}}" class="nav-link {{ Request::is('orders/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Add
                            </p>
                            </a>
                        </li>
                        @endcan --}}
                        @can('view')
                        <li class="nav-item">
                            <a href="{{route('orders.index')}}" class="nav-link {{ Request::is('orders') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                View
                            </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @endcanany

               <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-list-ul"></i>
                  <p>
                    Manage
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a> -->


                <!-- <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                            Customers
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Add Customer</p>
                            </a>
                          </li>
                        </ul> -->

                        <!-- <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>View Customer</p>
                            </a>
                          </li>
                        </ul> -->
                      <!-- </li>
                  </ul>-->
               </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
