<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Blog Test</title>
    <!-- Custom Css -->
    <link rel="stylesheet" href="/css/app.css">    
    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
      <img src="/static-img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/static-img/profile.png" alt="profile">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            {{ Auth::user()->name }}
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        @if (auth()->user()->isAdmin())
        <li class="nav-item">
          <a href="{{ route('users.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                  Users
              </p>
          </a>
        </li>

        @endif
        <li class="nav-item">
            <a href="{{ route('categories.index') }}" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Categories
                </p>
            </a>
        </li>    
        
        <li class="nav-item">
          <a href="{{ route('posts.index') }}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                  Posts
              </p>
          </a>
        </li> 
        
        <li class="nav-item">
          <a href="{{ route('tags.index') }}" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                  Tags
              </p>
          </a>
        </li>
       
        <li class="nav-item">
          <a href="{{ route('trashed-posts.index') }}" class="nav-link">
              <i class="nav-icon fas fa-trash"></i>
              <p>
                  Deleted Posts
              </p>
          </a>
        </li> 

        <li class="nav-item">
          <a href="{{ route("users.edit-profile") }}" class="nav-link">
            <i class="nav-icon fas fa-edit"></i> 
            <p>Edit Profile</p>
          </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-power-off text-red"></i>
              <p>Logout</p>
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container">
      @if (session()->has('s'))
        <div class="alert alert-success mt-2">
          {{ session()->get('s') }}
        </div>
      @endif
      @if (session()->has('error'))
      <div class="alert alert-danger mt-2">
        {{ session()->get('error') }}
      </div>
    @endif
      @yield('content')
    </div>
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Made with <i class="fa fa-heart"></i> by <a href="https://github.com/MDubovac"> Mladen Dubovac</a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 Blog Test</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="/js/app.js"></script> <!-- Main JS file -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script><!-- Summernote -->
<script>
  // Check for active menu link 
  const currentLocation = location.href;
  const menuItem = document.querySelectorAll('a');
  const menuLength = menuItem.length;
  for(let i = 0; i < menuLength; i++){
    if(menuItem[i] == currentLocation){
      menuItem[i].className = 'nav-link active';
    }
  }


</script>
</body>
</html>