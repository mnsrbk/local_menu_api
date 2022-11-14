@extends('layout')

@section('title') @lang('main.edit_ingredient') @endsection

@section('content')
  @include('include.block-header.min', ['data' => ['sub' => trans('main.edit_ingredient'), 'title' => $ingredient->name]])

  <form action="{{ route('ingredients.update', $ingredient->id) }}" class="form-contact needs-validation" method="POST" enctype="multipart/form-data" novalidate>
    @csrf
    @method('patch')
    <div class="card card-bordered mb-2">
      <div class="card-inner">
        <h5 class="float-title">@lang('main.name')</h5>
        <div class="row g-4">
          @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <div class="col-md-4">
              <div class="form-group">
                <label for="name-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
                <div class="form-control-wrap">
                  <input type="text" id="name-{{ $localeCode }}" name="name[{{ $localeCode }}]" value="{{ $ingredient->getTranslation('name', $localeCode) }}"
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
    <div class="card card-bordered mb-2">
        <div class="card-inner">
          <h5 class="float-title">@lang('main.unit')</h5>
          <div class="row g-4">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <div class="col-md-4">
                <div class="form-group">
                  <label for="unit-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
                  <div class="form-control-wrap">
                    <input type="text" id="unit-{{ $localeCode }}" name="unit[{{ $localeCode }}]" value="{{ $ingredient->getTranslation('unit', $localeCode) }}"
                           class="form-control form-control-lg @error('unit.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}" required>
                    @if ($errors->has('unit.' . $localeCode))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('unit.' . $localeCode) }}</strong></span>
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
      <div class="col-12">
        <button class="btn btn-primary">@lang('main.submit')</button>
      </div>
    
  </form>
@endsection

@section('js')
  <script>
      $(function () {
          let col_category = $('#col-category');
          let col_leaf = $('#col-leaf');
          let select = $('#col-category select');
          let checkbox_leaf = $('#col-leaf input');

          $('#has-parent').change(function () {
              if ($(this).is(':checked')) {
                  col_category.removeClass('d-none');
                  col_leaf.addClass('d-none');
                  select.prop('required', true);
                  select.prop('disabled', false);
                  checkbox_leaf.prop('disabled', true);
              } else {
                  col_category.addClass('d-none');
                  col_leaf.removeClass('d-none');
                  select.prop('required', false);
                  select.prop('disabled', true);
                  checkbox_leaf.prop('disabled', false);
              }
          });
      });
  </script>
@endsection
