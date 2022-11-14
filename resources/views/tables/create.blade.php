@extends('layout')

@section('title') @lang('main.create_new_table') @endsection

@section('content')
  @include('include.block-header.min', ['data' => ['sub' => trans('main.create_new'), 'title' => trans('main.table')]])

  <form action="{{ route('tables.store') }}" class="form-contact needs-validation" method="POST" novalidate>
    @csrf
    <div class="row g-4">
      <div class="col-12">
        <div class="form-group">
          <label class="form-label" for="hall"><span>@lang('main.hall')</span></label>
          <div class="form-control-wrap">
            <select class="form-select @error('hall_id') is-invalid @enderror" id="hall" name="hall_id" data-search="on"data-ui="lg">
              <option disabled hidden selected></option>
              @foreach ($halls as $hall)
                <option value="{{ $hall->id }}" {{ old('hall_id') == $hall->id ? 'selected' : '' }}>{{ $hall->name }}</option>
              @endforeach
            </select>
            @if ($errors->has('hall_id'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('hall_id') }}</strong></span>
            @else
              <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
            @endif
          </div>
        </div>
      </div>
      <div class="col-12">
        <label for="number" class="form-label">@lang('main.table_number')</label>
        <div class="form-control-wrap">
          <input type="number" id="number" name="number" class="form-control form-control-lg @error('number') is-invalid @enderror" placeholder="@lang('main.table_number')" value="{{ old('number') }}" min="1" required>
          @if ($errors->has('number'))
            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('number') }}</strong></span>
          @else
            <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
          @endif
        </div>
      </div>
      <div class="col-12">
        <button class="btn btn-primary">@lang('main.submit')</button>
      </div>
    </div>
  </form>
@endsection