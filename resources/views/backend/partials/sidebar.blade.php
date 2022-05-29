<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="/"><img src="{{ asset('img/logo-01.svg') }}" width="20%"> Cubeshape</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="/"><img src="{{ asset('img/logo-01.svg') }}"></a>
    </div>
    <ul class="sidebar-menu">
      @if(Auth::user()->role == 1)
        <div class="mt-4 p-3 hide-sidebar-mini">
          <a href="{{ url('admin/quiz/') }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Create New Quiz
          </a>
        </div>
        <li class="{{ (request()->is('admin/quiz*')) ? 'active' : '' }}">
          <a class="nav-link active" href="{{ url('admin/quiz/all') }}"><i class="fas fa-history"></i> Manage Quiz</a>
        </li>
      @endif

      @if(Auth::user()->role == 2)
        <li class="menu-header">Dashboard</li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
            <li><a class="nav-link" href="/">Ecommerce Dashboard</a></li>
          </ul>
        </li>
        <li class="{{ (request()->is('super-admin/user*')) ? 'active' : '' }}">
          <a class="nav-link active" href="{{ url('super-admin/user') }}"><i class="fas fa-user"></i> User</a>
        </li>
      @endif
    </ul>

  </aside>
</div>