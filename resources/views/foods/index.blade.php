@extends('layout')

@section('title') @lang('main.food_index') @endsection

@section('content')
  @include('include.block-header.index', ['data' => ['title' => trans('main.foods'), 'route' => route('foods.create') ]])
  <form action="" method="GET">
    <div class="form-row">
      <div class="col-md-8 mb-3 pt-2">
        <label class="form-label" for="search"><span>@lang('main.search')</span></label>
        <input type="text" class="form-control" name="q" value="{{ request('q') }}" placeholder="Name">
      </div>
      <div class="col-md-3 mb-3 pt-2">
        <label class="form-label" for="category"><span>@lang('main.category')</span></label>
        <select class="select" id="categories" name="categories[]" multiple="multiple">
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" @if (in_array($category->id, request('categories', []))) selected
                  @endif>{{ $category->name }}</option>
        @endforeach
      </select>
      </div>
      <div class="col-md-1 mb-3 pt-5">
          <button class="btn btn-primary" type="submit"><i data-icon="search"></i></button>
      </div>
    </div>
  </form>
  @include('include.tables.foods', ['data' => ['foods' => $foods]])
@endsection
    @section('js')
    <script>
        $(function() {
            $('.select').select2({
                width: '100%',
                minimumResultsForSearch: -1
            });
        });

    </script>
@endsection
