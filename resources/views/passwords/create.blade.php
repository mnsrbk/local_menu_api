@extends('layout')

@section('title') @lang('main.create_new_tablet_password') @endsection

@section('content')
  @include('include.block-header.min', ['data' => ['sub' => trans('main.create_new'), 'title' => trans('main.tablet_password')]])

  <form action="{{ route('passwords.store') }}" class="form-contact needs-validation" method="POST" novalidate>
    @csrf
    <div class="form-group">
      <label for="password" class="form-label">@lang('main.password')</label>
      <div class="form-control-wrap">
        <input type="number" id="password" name="code" value="{{ old('code') }}" class="form-control form-control-lg @error('code') is-invalid @enderror"
               placeholder="@lang('main.password_placeholder')" min="10000" max="99999" required>
        @if ($errors->has('code'))
          <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('code') }}</strong></span>
        @else
          <span class="invalid-feedback" role="alert"><strong>@lang('main.invalid_input')</strong></span>
        @endif
      </div>
    </div>

    <button class="btn btn-primary">@lang('main.submit')</button>
  </form>
@endsection