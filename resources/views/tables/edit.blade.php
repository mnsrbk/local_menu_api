@extends('layout')

@section('title') @lang('main.edit_table') @endsection

@section('content')
  @include('include.block-header.min', ['data' => ['sub' => trans('main.table_number'), 'title' => $table->number]])

  <form action="{{ route('tables.update', $table->id) }}" class="form-contact needs-validation" method="POST" novalidate>
    @csrf
    @method('patch')
    <div class="row g-4">
      <div class="col-12">
        <label for="number" class="form-label">@lang('main.table_number')</label>
        <div class="form-control-wrap">
          <input type="number" id="number" name="number" class="form-control form-control-lg @error('number') is-invalid @enderror" placeholder="@lang('main.table_number')"
                 value="{{ $table->number }}" min="1" required>
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