@extends('layout')

@section('title') @lang('main.add_food_ingredient') @endsection

@section('content')
    @include('include.block-header.min', ['data' => ['sub' => trans('main.add_food_ingredient'), 'title' => $food->name]])
    <div class="nk-block-head">
        <div class="nk-block-between-md g-4">
            <div class="nk-block-head-content"></div>
            <div class="nk-block-head-content">
                <ul class="nk-block-tools gx-3">
                    <li>
                        <span class=" clone_ingredient btn btn-white btn-dim btn-outline-primary">
                            <em class="icon ni ni-plus-c"></em><span class="d-none d-sm-inline-block">@lang('main.add')</span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <form action="{{ route('foods.ingredients.store', $food->id) }}" class="form-contact needs-validation" method="POST" novalidate>
            @csrf
            <div>
                <div class="card card-bordered mb-2 copy_ingredient mt-4">
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
                                        <input type="number" id="value" name="value[]" class="form-control form-control-lg @error('value') is-invalid @enderror" placeholder="@lang('main.value')"
                                               value="{{ old('value') }}" min="1" step="0.01">
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
        @if(count($food_ingredients))
            <div id="ingredients_wrapper" class="card card-bordered card-preview mt-4">
                <div class="card card-bordered card-preview">
                    <table class="table table-ulogs">
                        <thead class="thead-light">
                            <tr>
                                <th class="tb-col-os"><span class="overline-title">@lang('main.name')</span></th>
                                <th class="tb-col-time"><span class="overline-title">@lang('main.value')</span></th>
                                <th class="tb-col-action"><span class="overline-title">&nbsp;</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($food_ingredients as $food_ing)
                                <tr>
                                    <td class="tb-col-os" >{{ $food_ing->ingredient->name }}</td>
                                    <td class="tb-col-time">{{ $food_ing->value }} {{ $food_ing->ingredient->unit }}</td>
                                    <td class="tb-col-action">
                                        <a href="#" class="link-cross mr-sm-n1"
                                            onclick="if (confirm('{{ trans("main.want_to_remove") }}')) { document.getElementById('destroy-{{ $food_ing->id }}').submit(); }">
                                            <em class="icon ni ni-cross"></em>
                                        </a>
                                        <form action="{{ route('foods.ingredients.destroy', $food_ing->id) }}" method="post" id="destroy-{{ $food_ing->id }}">
                                            @method('delete')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
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
