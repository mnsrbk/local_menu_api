@extends('layout')

@section('title') @lang('main.add_food_price') @endsection

@section('content')
  @include('include.block-header.min', ['data' => ['sub' => trans('main.add_food_price'), 'title' => $food->name]])

  <form action="{{ route('foods.sizes.store', $food->id) }}" class="form-contact needs-validation" method="POST" novalidate>
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
                         class="form-control form-control-lg @error('name.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}">
                  @if ($errors->has('name.' . $localeCode))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name.' . $localeCode) }}</strong></span>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="price" class="form-label">@lang('main.price')</label>
      <div class="form-control-wrap">
        <input type="number" id="price" name="price" class="form-control form-control-lg @error('price') is-invalid @enderror" placeholder="@lang('main.price')"
               value="{{ old('price') }}" min="1" step="0.01" required>
        @if ($errors->has('price'))
          <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('price') }}</strong></span>
        @else
          <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
        @endif
      </div>
    </div>
    <p class="text-warning">***If food has single size do not type the name fields</p>
    <button class="btn btn-primary">@lang('main.submit')</button>
  </form>
@endsection