@extends('layout')

@section('title') @lang('main.create_new') @lang('main.service_cost') @endsection

@section('content')
  @include('include.block-header.min', ['data' => ['sub' => trans('main.create_new'), 'title' => trans('main.service_cost')]])

  <form action="{{ route('services.store') }}" class="form-contact needs-validation" method="POST" novalidate>
    @csrf
    <div class="form-group">
      <label for="cost" class="form-label">@lang('main.service_cost')</label>
      <div class="input-group form-control-wrap">
        <input class="form-control form-control-lg @error('cost') is-invalid @enderror" type="number" name="cost" id="cost" value="{{ old('cost') }}" min="0" step="0.01" autofocus required>
        @if ($errors->has('cost'))
          <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('cost') }}</strong></span>
        @else
          <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
        @endif
        <div class="input-group-append input-card-type">
          <select name="unit" class="input-group-text form-select" aria-label="discount" data-search="off" data-ui="lg">
            <option value="manat" @if (old('unit') == 'manat') selected @endif>@lang('main.manat')</option>
            <option value="percent" @if (old('unit') == 'percent') selected @endif>@lang('main.percent')</option>
          </select>
        </div>
      </div>
    </div>
    <button class="btn btn-primary">@lang('main.submit')</button>
  </form>
@endsection
