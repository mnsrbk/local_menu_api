@extends('layout')

@section('title') @lang('main.category_index') @endsection

@section('content')
  @include('include.block-header.index', ['data' => ['title' => trans('main.categories'), 'route' => route('categories.create'), 'route_order' => route('categories.order') ]])
  @include('include.search')
  @if(count($categories))
    <div class="nk-block">
      <div class="card card-bordered mb-5">
        <table class="table">
          <thead>
          <tr class="tb-tnx-head">
            <th></th>
            @foreach(LaravelLocalization::getSupportedLocales() as $properties)
              <th>{{ $properties['native'] }}</th>
            @endforeach
            <th>@lang('main.parent_category')</th>
            <th>@lang('main.leaf')</th>
            <th>@lang('main.foods')</th>
            <th>&nbsp;</th>
          </tr>
          </thead>
          <tbody>
          @foreach($categories as $category)
            <tr class="tb-tnx-item">
              <td>@if($category->is_drink) <em class="icon ni ni-coffee"></em> @endif</td>
              @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
                <td>{{ $category->getTranslation('name', $locale) }}</td>
              @endforeach
              <td>{{ $category->hasParent() ? $category->parent->name : '―' }}</td>
              <td>@if($category->is_leaf) <em class="icon ni ni-check"></em> @else ― @endif</td>
              <td>{{ $category->foodsCount() }}</td>
              <td class="tb-col-action">
                <span class="mr-1"><a href="{{ route('categories.show', $category->id) }}" class="link-cross link-eye mr-sm-n1"><em class="icon ni ni-eye"></em></a></span>
                <span class="mr-1"><a href="{{ route('categories.edit', $category->id) }}" class="link-cross link-edit mr-sm-n1"><em class="icon ni ni-edit-alt"></em></a></span>
                <span><a href="#" onclick="if (confirm('{{ trans("main.want_to_remove") }}')) { document.getElementById('destroy-{{ $category->id }}').submit(); }"
                         class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a></span>
                <form action="{{ route('categories.destroy', $category->id) }}" method="post" id="destroy-{{ $category->id }}">
                  @method('delete')
                  @csrf
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      @include('include.paginate', ['data' => ['items' => $categories, 'limit' => 10]])
    </div>
  @else
    <p>@lang('main.no_category')</p>
  @endif
@endsection