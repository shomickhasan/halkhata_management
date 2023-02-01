<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">হালখাতা-ম্যনেজমেন্ট</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user2-160x160.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
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
          <li class="nav-item menu-open">
            <a href="{{Route('app.dashboard')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                ড্যাশবোর্ড
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('customer.HalkhataView')}}" class="nav-link">
              <i class="text-primary nav-icon fas fa-th"></i>
              <p>
                হালখাতা
              </p>
            </a>
          </li>
        @if(Auth::guard('admin')->user()->role==1)
          <li class="nav-header text-primary">সুপার এডমিন প্যনেল</li>
          <li class="nav-item">
            <a href="{{Route('admin.user')}}" class="nav-link">
                <i class="text-primary fas fa-user"></i>
              <p>
                অ্যাডমিন তৈরি করুন
              </p>
            </a>
          </li>
          {{-- -------- --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="text-primary nav-icon fas fa-edit"></i>
              <p>
                ঠিকানা সংযুক্ত করন
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{Route('customer.village.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>গ্রাম</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{Route('customer.village.laid')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>পাড়া/মহল্লা</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- ---------- --}}
          <li class="nav-item">
            <a href="{{route('customer.index')}}" class="nav-link">
              <i class="text-primary fas fa-users"></i>
              <p>
                কাস্টমার এড করুন
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('pdf.Report')}}" class="nav-link">
            <i class="text-primary nav-icon fas fa-th"></i>
              <p>
                রিপোট জেনারেট করুন
              </p>
            </a>
          </li>
        @endif
          <li class="nav-item">
            <a href="{{Route('admin.logout')}}" class="nav-link">
                <i class="text-danger fas fa-sign-out-alt"></i>
              <p>লগ আউট</p></p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
