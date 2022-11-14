@extends('layout')

@section('title') @lang('main.create_new_food') @endsection

@section('content')
    @include('include.block-header.min', ['data' => ['sub' => trans('main.create_new'), 'title' => trans('main.food')]])

    <form action="{{ route('foods.store') }}" class="form-contact needs-validation" method="POST"
        enctype="multipart/form-data" novalidate>
        @csrf
        <div class="card card-bordered mb-2">
            <div class="card-inner">
                <h5 class="float-title">@lang('main.name')</h5>
                <div class="row g-4">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name-{{ $localeCode }}"
                                    class="form-label">{{ $properties['native'] }}</label>
                                <div class="form-control-wrap">
                                    <input type="text" id="name-{{ $localeCode }}" name="name[{{ $localeCode }}]"
                                        value="{{ old('name.' . $localeCode) }}"
                                        class="form-control form-control-lg @error('name.' . $localeCode) is-invalid @enderror"
                                        placeholder="{{ $properties['native'] }}" required>
                                    @if ($errors->has('name.' . $localeCode))
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $errors->first('name.' . $localeCode) }}</strong></span>
                                    @else
                                        <span class="invalid-feedback"
                                            role="alert"><strong>@lang('main.field_required')</strong></span>
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
                    <input type="file" id="file" name="file"
                        class="form-control form-control-lg @error('file') is-invalid @enderror"
                        placeholder="@lang('main.choose_image')" required>
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
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category"
                            name="category_id" data-search="on" data-ui="lg" required>
                            <option disabled hidden selected></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                            <span class="invalid-feedback"
                                role="alert"><strong>{{ $errors->first('category_id') }}</strong></span>
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
                        <input class="form-control form-control-lg" type="number" name="discount" id="discount"
                            value="{{ old('discount') }}" min="1" step="0.01">
                        <div class="input-group-append input-card-type">
                            <select name="discount_unit" class="input-group-text form-select" aria-label="discount"
                                data-search="off" data-ui="lg">
                                <option value="manat" @if (old('discount_unit') == 'manat') selected @endif>@lang('main.manat')</option>
                                <option value="percent" @if (old('discount_unit') == 'percent') selected @endif>@lang('main.percent')</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="sp-plan-opt">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input @error('active') is-invalid @enderror"
                            name="active" id="active" checked>
                        <label class="custom-control-label text-soft" for="active">@lang('main.is_active')</label>
                        @error('active')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h6 class="heading my-3">@lang('main.prices')</h6>
                <ul class="nav nav-tabs" id="priceTab" role="tablist">
                    @foreach ($tabs as $key => $tab)
                        <li class="nav-item">
                            <a class="nav-link {{ $key == 'single' ? 'active' : '' }}" id="{{ $key }}-tab"
                                data-toggle="tab" href="#{{ $key }}" role="tab" aria-controls="{{ $key }}"
                                aria-selected="{{ $key == 'single' ? 'true' : 'false' }}">{{ $tab['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content mb-36" id="priceTabContent">
                    @foreach ($tabs as $key => $tab)
                        <div class="tab-pane fade {{ $key == 'single' ? 'show active' : '' }}" id="{{ $key }}"
                            role="tabpanel" aria-labelledby="{{ $key }}-tab">
                            @for ($i = 1; $i <= $tab['loop_count']; $i++)
                                <div class="card card-bordered mb-2">
                                    <div class="card-inner">
                                        <h5 class="float-title">@lang('main.price') {{ $i }}</h5>
                                        @if ($tab['loop_count'] != 1)
                                            <div class="form-group">
                                                <label for="size" class="d-block">@lang('main.named_for_food_size')</label>
                                                <div class="input-group">
                                                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                        <input
                                                            class="form-control {{ $errors->has('size.*.' . $localeCode) ? 'is-valid' : '' }}"
                                                            type="text" name="size[][{{ $localeCode }}]"
                                                            aria-label="size-{{ $localeCode }}"
                                                            placeholder="{{ $properties['native'] }}"
                                                            {{ $key == 'single' ? 'required' : 'disabled' }}>
                                                    @endforeach
                                                </div>
                                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                    @if ($errors->has('type.*.' . $localeCode))
                                                        <span class="invalid-feedback"
                                                            role="alert"><strong>{{ $errors->first('size.*.' . $localeCode) }}</strong></span>
                                                    @else
                                                        <span class="invalid-feedback"
                                                            role="alert"><strong>@lang('main.must_write_size_name')</strong></span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="price-{{ $key }}">@lang('main.price')</label>
                                            <input type="number" id="price-{{ $key }}" name="price[]" step="0.01"
                                                class="form-control no-arrow {{ $errors->has('price.*') ? 'is-valid' : '' }}"
                                                {{ $key == 'single' ? 'required' : 'disabled' }}>
                                            @if ($errors->has('price.*'))
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $errors->first('price') }}</strong></span>
                                            @else
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>@lang('main.must_show_price')</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    @endforeach
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
        $(function() {
            $('b[role="presentation"]').hide();

            $('#priceTab .nav-link').click(function() {
                let tab_input = $('.tab-pane input');
                let this_input = $('#' + $(this).attr('aria-controls') + ' input');

                tab_input.prop('disabled', true);
                tab_input.removeAttr('required');

                this_input.prop('disabled', false);
                this_input.prop('required', true);
            });

            let form_select = $(".form-select");
            let select = $(".form-select select");
            let has_category = $("#has_category");

            toggleForm(has_category);

            has_category.change(function() {
                toggleForm($(this));
            })
        });
    </script>
@endsection
