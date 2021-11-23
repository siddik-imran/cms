<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>RuangAdmin - Dashboard</title>
  <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/admin/css/ruang-admin.min.css') }}" rel="stylesheet">

  <link href="{{ asset('css/toaster.min.css') }}" rel="stylesheet" type="text/css">

   @yield('css')

</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    @if(Auth::user())
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="{{ asset('assets/admin/img/logo/logo2.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item  {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" >
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Features
      </div>
      <li class="nav-item {{ Route::currentRouteName() == 'categories.*' ? 'active' : '' }}" >
        <a class="nav-link" href="{{ route('categories.index') }}">
            <i class="fas fa-list"></i>
          <span>Categories</span>
        </a>
      </li>
      <li class="nav-item {{ Route::currentRouteName() == 'tags.*' ? 'active' : '' }}" >
        <a class="nav-link" href="{{ route('tags.index') }}">
            <i class="fas fa-list"></i>
          <span>Tags</span>
        </a>
      </li>
      <li class="nav-item {{ Route::currentRouteName() == 'posts.*' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('posts.index') }}">
            <i class="fas fa-list"></i>
          <span>Posts</span>
        </a>
      </li>

      <li class="nav-item {{ Route::currentRouteName() == 'users.*' ? 'active' : '' }}" >
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
          <span>Users</span>
        </a>
      </li>
      <li class="nav-item {{ Route::currentRouteName() == 'trashed-posts.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('trashed-posts.index') }}">
            <i class="far fa-trash-alt"></i>
          <span>Trashed</span>
        </a>
      </li>

    </ul>

    <!--End Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
                      aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>


            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="{{ (Auth::user()->image != Null) ? asset('users/'. Auth::user()->image) : asset('assets/admin/img/boy.png') }}" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">
                    @if (Auth::user())
                       {{ Auth::user()->name }}
                    @endif
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('users.edit-profile') }}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}


                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End Topbar -->
        @endif
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <ol class="breadcrumb">
              @if(Auth::user())<li class="breadcrumb-item"><a href="./">Home</a></li>@endif
              <li class="breadcrumb-item active" aria-current="page">@yield('page_name')</li>
            </ol>
          </div>

          <div class="row mb-3">

                @yield('content')

            </div>
        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      {{-- <footer class="sticky-footer bg-white" style="margin-top: 50vh ">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed with
              <b><a href="https://indrijunanda.gitlab.io/" target="_blank">care & love</a></b>
            </span>
          </div>
        </div>
      </footer> --}}
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/ruang-admin.min.js') }}"></script>
  <script src="{{ asset('assets/admin/vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/demo/chart-area-demo.js') }}"></script>

  <script src="{{ asset('js/toaster.min.js') }}"></script>

  <script>
      @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
      @endif

      @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}")
      @endif

      @if (Session::has('error'))
        toastr.error("{{ Session::get('error') }}")
      @endif
  </script>

  @yield('script')

</body>

</html>
