<!DOCTYPE html>
<html lang="en" class="js">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Pikir">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Loft menu dashboard">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}" type="image/x-icon"/>
  <link rel="apple-touch-icon" href="{{ asset('images/favicon/apple-touch-icon.png') }}"/>
  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicon/apple-touch-icon-57x57.png') }}"/>
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon/apple-touch-icon-72x72.png') }}"/>
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon/apple-touch-icon-76x76.png') }}"/>
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon/apple-touch-icon-114x114.png') }}"/>
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon/apple-touch-icon-120x120.png') }}"/>
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/apple-touch-icon-144x144.png') }}"/>
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon/apple-touch-icon-152x152.png') }}"/>
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon-180x180.png') }}"/>
  <title>@yield('title') | Menu Dashboard &mdash; Pikir</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  @yield('css')
</head>

<body class="nk-body npc-subscription has-aside ui-clean">
<div id="messages">
  @include('include.messages')
</div>
<div class="nk-app-root">
  <div class="nk-main ">
    <div class="nk-wrap ">
      <div class="nk-header nk-header-fixed is-light">
        <div class="container-lg wide-xl">
          <div class="nk-header-wrap">
            <div class="nk-header-brand">
              <a href="{{ route('index') }}" class="logo-link">
                <img class="logo-light logo-img" src="{{ asset('images/logo-light.svg') }}" srcset="{{ asset('images/logo-light-2x.svg 2x') }}" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('images/logo-dark.svg') }}" srcset="{{ asset('images/logo-dark-2x.svg 2x') }}" alt="logo-dark">
                {{-- <span class="nio-version">Menu</span> --}}
              </a>
            </div>
            <div class="nk-header-tools">
              <ul class="nk-quick-nav">
                <li class="dropdown user-dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <div class="user-toggle">
                      <div class="user-avatar sm">
                        <em class="icon ni ni-user-alt"></em>
                      </div>
                      <div class="user-name dropdown-indicator d-none d-sm-block">{{ auth()->user()->name }}</div>
                    </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                    <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                      <div class="user-card">
                        <div class="user-avatar">
                          <span><em class="icon ni ni-user-alt"></em></span>
                        </div>
                        <div class="user-info">
                          <span class="lead-text">{{ auth()->user()->name }}</span>
                          <span class="sub-text">{{ auth()->user()->username }}</span>
                        </div>
                        <div class="user-action">
                          <a class="btn btn-icon mr-n2" href="{{ route('profile') }}"><em class="icon ni ni-setting"></em></a>
                        </div>
                      </div>
                    </div>
                    <div class="dropdown-inner">
                      <ul class="link-list">
                        <li><a href="{{ route('profile') }}"><em class="icon ni ni-user-alt"></em><span>@lang('main.view_profile')</span></a></li>
                        <li><a href="{{ route('restaurant') }}"><em class="icon ni ni-home-alt"></em><span>@lang('main.restaurant_settings')</span></a></li>
                      </ul>
                    </div>
                    <div class="dropdown-inner">
                      <ul class="link-list">
                        <li>
                          <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <em class="icon ni ni-signout"></em><span>@lang('main.log_out')</span>
                          </a>
                          <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">@csrf</form>
                        </li>
                      </ul>
                    </div>
                  </div>
                </li>
                <li class="d-lg-none">
                  <a href="#" class="toggle nk-quick-nav-icon mr-n1" data-target="sideNav"><em class="icon ni ni-menu"></em></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="nk-content ">
        <div class="container wide-xl">
          <div class="nk-content-inner">
            <div class="nk-aside" data-content="sideNav" data-toggle-overlay="true" data-toggle-screen="lg" data-toggle-body="true">
              <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                  <li class="nk-menu-heading">
                    <h6 class="overline-title">@lang('main.menu')</h6>
                  </li>
                  <li class="nk-menu-item {{ request()->is(app()->getLocale()) ? 'active' : '' }}">
                    <a href="{{ route('index') }}" class="nk-menu-link">
                      <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span><span class="nk-menu-text">@lang('main.dashboard')</span>
                    </a>
                  </li>
                  <li class="nk-menu-item {{ request()->is('categories*') ? 'active' : '' }}">
                    <a href="{{ route('categories.index') }}" class="nk-menu-link">
                      <span class="nk-menu-icon"><em class="icon ni ni-folder-list"></em></span><span class="nk-menu-text">@lang('main.categories')</span>
                    </a>
                  </li>
                  <li class="nk-menu-item {{ request()->is('ingredients*') ? 'active' : '' }}">
                    <a href="{{ route('ingredients.index') }}" class="nk-menu-link">
                      <span class="nk-menu-icon"><em class="icon ni ni-coffee"></em></span><span class="nk-menu-text">@lang('main.ingredients')</span>
                    </a>
                  </li>
                  <li class="nk-menu-item {{ request()->is('foods*') ? 'active' : '' }}">
                    <a href="{{ route('foods.index') }}" class="nk-menu-link">
                      <span class="nk-menu-icon"><em class="icon ni ni-disk"></em></span><span class="nk-menu-text">@lang('main.foods')</span>
                    </a>
                  </li>
                  <li class="nk-menu-item {{ request()->is('halls*') ? 'active' : '' }}">
                    <a href="{{ route('halls.index') }}" class="nk-menu-link">
                      <span class="nk-menu-icon"><em class="icon ni ni-home-alt"></em></span><span class="nk-menu-text">@lang('main.halls')</span>
                    </a>
                  </li>
                  <li class="nk-menu-item {{ request()->is('tables*') ? 'active' : '' }}">
                    <a href="{{ route('tables.index') }}" class="nk-menu-link">
                      <span class="nk-menu-icon"><em class="icon ni ni-grid-alt "></em></span><span class="nk-menu-text">@lang('main.tables')</span>
                    </a>
                  </li>
                  <li class="nk-menu-item {{ request()->is('orders*') ? 'active' : '' }}">
                    <a href="{{ route('orders.index') }}" class="nk-menu-link">
                      <span class="nk-menu-icon"><em class="icon ni ni-cc-alt"></em></span><span class="nk-menu-text">@lang('main.orders')</span>
                    </a>
                  </li>
                  <li class="nk-menu-heading">
                    <h6 class="overline-title">@lang('main.language')</h6>
                  </li>
                  @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if($localeCode == app()->getLocale())
                      <li class="nk-menu-item active">
                        <span class="nk-menu-link"><span class="nk-menu-text">{{ $properties['native'] }}</span></span>
                      </li>
                    @else
                      <li class="nk-menu-item">
                        <a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="nk-menu-link">
                          <span class="nk-menu-text">{{ $properties['native'] }}</span>
                        </a>
                      </li>
                    @endif
                  @endforeach
                </ul>
              </div>
              <div class="nk-aside-close"><a href="#" class="toggle" data-target="sideNav"><em class="icon ni ni-cross"></em></a></div>
            </div>
            <div class="nk-content-body">
              <div class="nk-content-wrap">
                @yield('content')
              </div>
              <div class="nk-footer">
                <div class="container wide-xl">
                  <div class="nk-footer-wrap g-2">
                    <div class="nk-footer-copyright">&copy; {{ date('Y') }} <a href="http://pikir.biz">Pikir</a>. @lang('main.all_rights_reserved')
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/bundle.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
<script>
  $(function () {
        $('i[data-icon="home"]').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>');
        $('i[data-icon="grid"]').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>');
        $('i[data-icon="product"]').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>');
        $('i[data-icon="project"]').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>');
        $('i[data-icon="store"]').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>');
        $('i[data-icon="collection"]').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>');
        $('i[data-icon="leaf"]').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path><line x1="16" y1="8" x2="2" y2="22"></line><line x1="17.5" y1="15" x2="9" y2="15"></line></svg>');
        $('i[data-icon="logout"]').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>');
        $('i[data-icon="search"]').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>');
        $('i[data-icon="folder"]').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>');
        $('i[data-icon="user"]').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>');

      @if($errors->any() || session('success') || session('error') || session('warning') || session('danger'))
      setTimeout(function () {
          $('#messages').fadeOut('slow');
      }, 5000);
      @endif
    });
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            let forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    $(function () {
      @if($errors->any() || session('success') || session('error') || session('warning') || session('danger'))
      setTimeout(function () {
          $('#messages').fadeOut('slow');
      }, 5000);
      @endif

      @if(! request()->is(app()->getLocale()))
      $(function () {
          $('.nk-menu-item').first().removeClass('active', 'current-page')
      });
      @endif
    });
</script>

@yield('js')

</body>
</html>
