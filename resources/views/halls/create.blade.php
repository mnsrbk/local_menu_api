@extends('layout')

@section('title') @lang('main.create_new_hall') @endsection

@section('content')
  @include('include.block-header.min', ['data' => ['sub' => trans('main.create_new'), 'title' => trans('main.hall')]])

  <form action="{{ route('halls.store') }}" class="form-contact needs-validation" method="POST" novalidate>
    @csrf
    <div class="card card-bordered mb-2">
      <div class="card-inner">
        <h5 class="float-title">@lang('main.name')</h5>
        <div class="row g-4">
          @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <div class="col-md-4">
              <div class="form-group">
                <label for="name-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
                <div class="form-control-wrap">
                  <input type="text" id="name-{{ $localeCode }}" name="name[{{ $localeCode }}]" value="{{ old('name.' . $localeCode) }}"
                         class="form-control form-control-lg @error('name.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}" required>
                  @if ($errors->has('name.' . $localeCode))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name.' . $localeCode) }}</strong></span>
                  @else
                    <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <button class="btn btn-primary">@lang('main.submit')</button>
  </form>
@endsection