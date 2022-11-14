@extends('layout')

@section('title') @lang('main.ingredient_index') @endsection

@section('content')
  @include('include.block-header.index', ['data' => ['title' => trans('main.ingredients'), 'route' => route('ingredients.create') ]])
  @include('include.search')
  @if(count($ingredients))
    <div class="nk-block">
      <div class="card card-bordered mb-5">
        <table class="table">
          <thead>
          <tr class="tb-tnx-head">
            @foreach(LaravelLocalization::getSupportedLocales() as $properties)
              <th>{{ $properties['native'] }}</th>
            @endforeach
            <th>@lang('main.unit')</th>
            {{-- <th>@lang('main.foods')</th> --}}
            <th>&nbsp;</th>
          </tr>
          </thead>
          <tbody>
          @foreach($ingredients as $ingredient)
            <tr class="tb-tnx-item">
              @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
                <td>{{ $ingredient->getTranslation('name', $locale) }}</td>
              @endforeach
              <td>{{ $ingredient->unit }}</td>
              {{-- <td>{{ $category->foodsCount() }}</td> --}}
              <td class="tb-col-action">

                <span class="mr-1"><a href="{{ route('ingredients.edit', $ingredient->id) }}" class="link-cross link-edit mr-sm-n1"><em class="icon ni ni-edit-alt"></em></a></span>
                <span><a href="#" onclick="if (confirm('{{ trans("main.want_to_remove") }}')) { document.getElementById('destroy-{{ $ingredient->id }}').submit(); }"
                         class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a></span>
                <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="post" id="destroy-{{ $ingredient->id }}">
                  @method('delete')
                  @csrf
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      @include('include.paginate', ['data' => ['items' => $ingredients, 'limit' => 10]])
    </div>
  @else
    <p>@lang('main.no_ingredient')</p>
  @endif
@endsection
