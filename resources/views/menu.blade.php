<!DOCTYPE html>
<html lang="en" class="js">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Pikir">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Lemon Bar & Lounge menu">
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
  <title>@yield('title') | Green Salad</title>
  <link rel="stylesheet" href="{{ mix('css/menu.css') }}">
  @yield('css')
</head>

<body class="nk-body npc-subscription has-aside ui-clean green-salad">
<div id="messages">
  @include('include.messages')
</div>
<div class="nk-app-root">
  <div class="nk-main ">
    <div class="nk-wrap ">
      <div class="header">
        <div class="container">
          <div class="d-flex">
            <div class="logo-container">
              <a href="{{ route('home') }}" class="">
                <img class="logo-green-salad logo-img d-none d-md-block" src="{{ asset('images/greenSalad.svg') }}" srcset="{{ asset('images/greenSalad.svg') }}" alt="logo">
                <img class="logo-green-salad logo-img d-block d-md-none" src="{{ asset('images/logo.svg') }}" srcset="{{ asset('images/logo.svg') }}" alt="logo">
                <!-- <img class="logo-light logo-img" src="{{ asset('images/logo-bg.png') }}" srcset="{{ asset('images/logo-bg.png') }}" alt="logo"> -->
              </a>
            </div>
            <div class="lang-switcher mt-3">
              <a class="btn dropdown-toggle p-0" data-toggle="dropdown" href="#">
                <span class="locale-link" style="color: #00BA54">
                  <span class="locale-text text-capitalize">{{ LaravelLocalization::getCurrentLocaleName() }}</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 19 19">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" stroke="currentColor" stroke-width="1"/>
                  </svg>
                  {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                  </svg> --}}
                </span>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-right">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                  @if($localeCode == app()->getLocale())
                    <!-- <li class="locale-item active">
                      <span class="locale-link"><span class="locale-text">{{ $localeCode }}</span></span>
                    </li> -->
                  @else
                    <li class="locale-item">
                      <a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="locale-link">
                        <span class="locale-text">{{ $properties["name"] }}</span>
                      </a>
                    </li>
                  @endif
                @endforeach
              </ul>
              
            </div>
          </div>
        </div>
      </div>
      
      <div class="nk-content">
        @yield('content')
      </div>
      <div class="nk-footer mb-3">
        <div class="container">
          <div class="nk-footer-wrap g-2">
            <div class="nk-footer-copyright">&copy;{{ date('Y') }} Green Salad. <span class="float-right">Powered by <a href="http://pikir.biz">Pikir</a>.</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/bundle.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>

@yield('js')

</body>
</html>