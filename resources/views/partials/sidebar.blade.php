@php
$menus = [
    [
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
        'icon' => 'dashboard',
        'roles' => ['admin'],
    ],
    [
        'group' => 'Product Management',
    ],
    [
        'name' => 'Products',
        'url' => route('admin.products.index'),
        'icon' => 'inventory_2',
        'roles' => ['admin'],
    ],
    [
        'name' => 'Categories',
        'url' => route('admin.categories.index'),
        'icon' => 'category',
        'roles' => ['admin'],
    ],
    // [
    //     'name' => 'Users',
    //     'url' => route('admin.users.index'),
    //     'icon' => 'table',
    //     'roles' => ['admin'],
    // ],
    [
        'group' => 'Account pages',
    ],
    [
        'name' => 'Logout',
        'url' => route('logout'),
        'icon' => 'logout',
        'roles' => ['admin', 'pt'],
    ],
];
@endphp


<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" id="iconSidenav"></i>
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
              $isActive = request()->url() === $menu['url'];
            @endphp
            <li class="nav-item">
              <a class="nav-link {{ $isActive ? 'active bg-gradient-dark text-white' : 'text-dark' }}" href="{{ $menu['url'] }}">
                <i class="material-symbols-rounded opacity-5">{{ $menu['icon'] }}</i>
                <span class="nav-link-text ms-1">{{ $menu['name'] }}</span>
              </a>
            </li>
          @endif
        @endforeach
      </ul>
  </div>
</aside>
