<header class="main-header">
  <!-- Logo -->
  <a href="{{url('/')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>UP</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>MONAS</b>&nbsp;UP</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{url('adminlte/dist/img/user.png')}}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{Auth::user()->name}}</span>
          </a>
          <ul class="dropdown-menu">
            <a class="pull-right btn btn-danger btn-flat" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out">&nbsp;</i>Keluar
            </a>
            <a class="pull-left btn btn-info btn-flat" href="{{ url('ubahdata') }}">
                <i class="fa fa-edit">&nbsp;</i>Ubah Data Pengguna
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>

          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
