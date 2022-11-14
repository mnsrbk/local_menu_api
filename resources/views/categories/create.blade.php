@extends('layout')

@section('title') @lang('main.create_new_category') @endsection

@section('content')
  @include('include.block-header.min', ['data' => ['sub' => trans('main.create_new'), 'title' => trans('main.category')]])

  {{--  TODO: remove errors log --}}
  {{--    @if ($errors->any())--}}
  {{--      <div class="alert alert-danger">--}}
  {{--        <ul>--}}
  {{--          @foreach ($errors->all() as $error)--}}
  {{--            <li>{{ $error }}</li>--}}
  {{--          @endforeach--}}
  {{--        </ul>--}}
  {{--      </div>--}}
  {{--    @endif--}}
  <form action="{{ route('categories.store') }}" class="form-contact needs-validation" method="POST" enctype="multipart/form-data" novalidate>
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
    <div class="row g-4">
      <div class="col-12">
        <label for="file" class="form-label">@lang('main.image')</label>
        <div class="form-control-wrap">
          <input type="file" id="file" name="file" class="form-control form-control-lg @error('file') is-invalid @enderror" placeholder="@lang('main.choose_image')" required>
          @if ($errors->has('file'))
            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('file') }}</strong></span>
          @else
            <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
          @endif
        </div>
      </div>

      <div class="col-md-4">
        <div class="sp-plan-opt">
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input @error('has_parent') is-invalid @enderror" name="has_parent"
                   id="has-parent" {{ old('has_parent') ? 'checked' : '' }}>
            <label class="custom-control-label text-soft" for="has-parent">@lang('main.parent_category_exists')</label>
            @error ('has_parent')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>
        </div>
      </div>
      <div class="col-md-4" id="col-leaf">
        <div class="sp-plan-opt">
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" name="is_leaf" id="is-leaf" value="1" checked>
            <label class="custom-control-label text-soft" for="is-leaf">@lang('main.is_it_leaf_category')</label>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="sp-plan-opt">
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" name="is_drink" id="is-drink" value="1">
            <label class="custom-control-label text-soft" for="is-drink">@lang('main.is_it_drink_category')</label>
          </div>
        </div>
      </div>

      <div class="col-12 {{ old('parent_id') || old('has_parent') ? '' : 'd-none' }}" id="col-category">
        <div class="form-group">
          <label class="form-label" for="category"><span>@lang('main.category')</span></label>
          <div class="form-control-wrap">
            <select class="form-select @error('parent_id') is-invalid @enderror" id="category" name="parent_id" data-search="on"
                    data-ui="lg" {{ old('parent_id') || old('has_parent') ? '' : 'disabled' }}>
              <option disabled hidden selected></option>
              @foreach ($parents as $parent)
                <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
              @endforeach
            </select>
            @if ($errors->has('parent_id'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('parent_id') }}</strong></span>
            @else
              <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
            @endif
          </div>
        </div>
      </div>
      <div class="col-12">
        <button class="btn btn-primary">@lang('main.submit')</button>
      </div>
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
                  select.prop('required', true);
                  select.prop('disabled', false);
                  // col_leaf.addClass('d-none');
                  // checkbox_leaf.prop('disabled', true);
              } else {
                  col_category.addClass('d-none');
                  select.prop('required', false);
                  select.prop('disabled', true);
                  // col_leaf.removeClass('d-none');
                  // checkbox_leaf.prop('disabled', false);
              }
          });
      });
  </script>
@endsection