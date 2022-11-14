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
  <title>@lang('main.sign_in') | Menu Dashboard &mdash; Pikir</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  @yield('css')
</head>

<body class="nk-body npc-crypto ui-clean pg-auth">
<div class="nk-app-root">
  <div class="nk-split nk-split-page nk-split-md">
    <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container">
      <div class="absolute-top-right d-lg-none p-3 p-sm-5">
        <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
      </div>
      <div class="nk-block nk-block-middle nk-auth-body">
        <div class="brand-logo pb-5">
          <a href="{{ route('index') }}" class="logo-link">
            <img class="logo-light logo-img" src="{{ asset('images/logo-light.svg') }}" srcset="{{ asset('images/logo-light-2x.svg 2x') }}" alt="logo">
            <img class="logo-dark logo-img" src="{{ asset('images/logo-dark.svg') }}" srcset="{{ asset('images/logo-dark-2x.svg 2x') }}" alt="logo-dark">
          </a>
        </div>
        <div class="nk-block-head">
          <div class="nk-block-head-content">
            <h5 class="nk-block-title">@lang('main.sign_in')</h5>
            <div class="nk-block-des">
              <p>@lang('main.access_dashboard')</p>
            </div>
          </div>
        </div>

        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="form-group">
            <div class="form-label-group">
              <label class="form-label" for="username">@lang('main.username')</label>
            </div>
            <input type="text" class="form-control form-control-lg" id="username" placeholder="@lang('main.enter_username')" name="username"
                   {{ $errors->has('username') ? ' is-invalid' : '' }} value="{{ old('username') }}" required autofocus>
            @if ($errors->has('username'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('username') }}</strong></span>
            @endif
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <label class="form-label" for="password">@lang('main.password')</label>
            </div>
            <div class="form-control-wrap">
              <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
              </a>
              <input type="password" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password"
                     placeholder="@lang('main.enter_password')">
              @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
              @endif
            </div>
          </div>
          <div class="custom-control custom-checkbox mb-4">
            <input type="checkbox" class="custom-control-input" name="remember" id="remember" value="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="custom-control-label" for="remember">@lang('main.remember_me')</label>
          </div>
          <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block">@lang('main.sign_in')</button>
          </div>
        </form>
      </div>
      <div class="nk-block nk-auth-footer">
        <div class="nk-block-between">
          <ul class="nav nav-sm">
            <li class="nav-item dropup">
              <a class="dropdown-toggle dropdown-indicator has-indicator nav-link" data-toggle="dropdown" data-offset="0,10">
                <small>{{ LaravelLocalization::getCurrentLocaleName() }}</small>
              </a>
              <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <ul class="language-list">
                  @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if($localeCode == app()->getLocale())
                      <li>
                        <a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="language-item">
                          <span class="language-name">{{ $properties['native'] }}</span>
                        </a>
                      </li>
                    @endif
                  @endforeach
                </ul>
              </div>
            </li>
          </ul>
        </div>
        <div class="mt-3">
          <p>&copy; {{ date('Y') }} <a href="http://pikir.biz">Pikir</a>. @lang('main.all_rights_reserved').</p>
        </div>
      </div>
    </div>

    <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right" data-content="athPromo" data-toggle-screen="lg"
         data-toggle-overlay="true">
      <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
        <div class="slider-init" data-slick='{"dots":false, "arrows":false}'>
          <div class="slider-item">
            <div class="nk-feature nk-feature-center">
              <div class="nk-feature-img">
                {{-- Restourant image or logo goes here --}}
                <img class="round" src="{{ asset('images/dish.jpg') }}" srcset="{{ asset('images/dish.jpg') }}" alt="img">
              </div>
            </div>
          </div>
        </div>
        <div class="slider-dots"></div>
        <div class="slider-arrows"></div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/bundle.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>