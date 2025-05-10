@php
$menus = [
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
        'route' => 'admin.dashboard',
        'icon' => 'dashboard',
        'roles' => ['admin'],
    ],
    [
        'group' => 'Product Management',
    ],
    [
        'name' => 'Products',
        'url' => route('admin.products.index'),
        'route' => 'admin.products.index',
        'icon' => 'inventory_2',
        'roles' => ['admin'],
    ],
    [
        'name' => 'Categories',
        'url' => route('admin.categories.index'),
        'route' => 'admin.categories.index',
        'icon' => 'category',
        'roles' => ['admin'],
    ],
    [
        'group' => 'Account pages',
    ],
    [
        'name' => 'Logout',
        'url' => route('logout'),
        'icon' => 'logout',
        'roles' => ['admin', 'pt'],
        'is_logout' => true,
    ],
];
@endphp

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
  <div class="sidenav-header">
    <a class="navbar-brand px-4 py-3 m-0" href="#">
      <img src="/assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
      <span class="ms-1 text-sm text-dark">{{ config('app.name') }}</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0 mb-2">
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
        @foreach ($menus as $menu)
            @if (isset($menu['group']))
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">
                        {{ $menu['group'] }}
                    </h6>
                </li>
            @elseif (in_array(auth()->user()->role, $menu['roles']))
                @php
                    $isActive = isset($menu['route']) && request()->routeIs($menu['route']);
                @endphp
                <li class="nav-item">
                    @if (!empty($menu['is_logout']))
                        <form id="logout-form" action="{{ $menu['url'] }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a href="#" class="nav-link text-dark" id="logout-btn">
                            <i class="material-symbols-rounded opacity-5">{{ $menu['icon'] }}</i>
                            <span class="nav-link-text ms-1">{{ $menu['name'] }}</span>
                        </a>
                    @else
                        <a class="nav-link {{ $isActive ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ $menu['url'] }}">
                            <i class="material-symbols-rounded opacity-5">{{ $menu['icon'] }}</i>
                            <span class="nav-link-text ms-1">{{ $menu['name'] }}</span>
                        </a>
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
  </div>
</aside>
