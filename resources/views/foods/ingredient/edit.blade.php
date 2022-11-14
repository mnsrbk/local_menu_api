@extends('layout')

@section('title') @lang('main.edit_food_price') @endsection

@section('content')
  @include('include.block-header.min', ['data' => ['sub' => trans('main.edit_food_price'), 'title' => $size->food->name ]])

  <form action="{{ route('foods.sizes.update', $size->id) }}" class="form-contact needs-validation" method="POST" novalidate>
    @csrf
    @method('patch')

    <div>
        <div class="card card-bordered mb-2 copy_ingredient">
            <div class="card-inner position-relative">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-label" for="area">@lang('main.ingredient') </label>
                          <div class="form-control-wrap">
                            <select class="form-control @error('ingredient_id') is-invalid @enderror"
                                id="ingredient" name="ingredient_id[]" data-search="on" >
                                @foreach($ingredients as $ingredient)
                                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('ingredient_id'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('ingredient_id') }}</strong></span>
                            @else
                                <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                            @endif
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="value" class="form-label">@lang('main.value')</label>
                          <div class="form-control-wrap">
                            <input type="number" id="value" name="value[]" class="form-control form-control-lg @error('value') is-invalid @enderror" placeholder="@lang('main.price')"
                                   value="{{ old('value') }}" min="1" step="0.01" required>
                            @if ($errors->has('value'))
                              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('value') }}</strong></span>
                            @else
                              <span class="invalid-feedback" role="alert"><strong>@lang('main.field_required')</strong></span>
                            @endif
                          </div>
                        </div>
                    </div>
                </div>
                <span class="btn text-danger btn-sm edit-delete position-absolute remove_ingredient" style="top: -15px; right: -35px; font-size:30px " title="Remove"><em class="icon ni ni-cross-circle-fill"></em></span>
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
    $(function() {
      const remove = $(".remove_ingredient");
      const onremove = $(".onclick_remove_ingredient");
      $('b[role="presentation"]').hide();
      remove.click(function() {
        $(this).parents('.copy_ingredient').remove();
      });
      onremove.click(function() {
        $(this).parents('.on_copy_ingredient').remove();
      });
      let cloneDiv = $('.copy_ingredient').clone(true);
      $('.clone_ingredient').click(function() {
        cloneDiv.children()[0].value = '';
        $('.copy_ingredient').parent().append(cloneDiv.clone(true));
      });
      remove.remove();
    });

  </script>
  @endsection
