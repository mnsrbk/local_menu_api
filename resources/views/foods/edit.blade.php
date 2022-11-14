@extends('layout')

@section('title') @lang('main.edit_food') @endsection

@section('content')
  @include('include.block-header.min', ['data' => ['sub' => trans('main.edit_food'), 'title' => $food->name]])

  <form action="{{ route('foods.update', $food->id) }}" class="form-contact needs-validation" method="POST" enctype="multipart/form-data" novalidate>
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
                  <input type="text" id="name-{{ $localeCode }}" name="name[{{ $localeCode }}]" value="{{ $food->getTranslation('name', $localeCode) }}"
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
          <input type="file" id="file" name="file" class="form-control form-control-lg @error('file') is-invalid @enderror" placeholder="@lang('main.choose_image')">
          @if ($errors->has('file'))
            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('file') }}</strong></span>
          @else
            <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
          @endif
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="form-label" for="category"><span>@lang('main.category')</span></label>
          <div class="form-control-wrap">
            <select class="form-select @error('category_id') is-invalid @enderror" id="category" name="category_id" data-search="on" data-ui="lg" required>
              <option disabled hidden selected></option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $food->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
              @endforeach
            </select>
            @if ($errors->has('category_id'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('category_id') }}</strong></span>
            @else
              <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
            @endif
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="discount" class="form-label">@lang('main.discount')</label>
          <div class="input-group form-control-wrap">
            <input class="form-control form-control-lg" type="number" name="discount" id="discount" value="{{ $food->discount }}" min="1" step="0.01">
            <div class="input-group-append input-card-type">
              <select name="discount_unit" class="input-group-text form-select" aria-label="discount" data-search="off" data-ui="lg">
                <option value="manat" @if ($food->discount_unit == 'manat') selected @endif>@lang('main.manat')</option>
                <option value="percent" @if ($food->discount_unit == 'percent') selected @endif>@lang('main.percent')</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="sp-plan-opt">
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input @error('active') is-invalid @enderror" name="active" id="active" value="1" {{ $food->is_active ? 'checked' : '1' }}>
            <label class="custom-control-label text-soft" for="active">@lang('main.is_active')</label>
            @error ('active')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>
        </div>
      </div>
      <div class="col-12">
        <button class="btn btn-primary">@lang('main.submit')</button>
      </div>
    </div>
  </form>
@endsection
