@extends('layout')

@section('title') @lang('main.ordering_category') @endsection

@section('css')
  <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
  <style>
    #sortable {
      list-style-type: none;
      margin: 0;
      padding: 0;
      width: 60%;
    }

    #sortable li {
      margin: 0 3px 3px 3px;
      padding: 0.4em 0.4em 0.4em 0;
      float: unset;
      text-align: left;
      cursor: grabbing;
    }
  </style>
@endsection

@section('content')
  @include('include.block-header.min', ['data' => ['sub' => trans('main.ordering'), 'title' => trans('main.category')]])

  <h5 class="title">{{ trans('main.ordering_category') }}</h5>
  <form action="{{ route('categories.order.update') }}" method="post" class="needs-validation mt-4" enctype="multipart/form-data" novalidate>
    @csrf
    @method('patch')
    <ul id="sortable" class="mb-5">
      @foreach($categories as $category)
        <li>
          <span class="sort-icon mr-2"><em class="icon ni ni-grid-sq"></em></span>
          <span>{{ $category->name }}</span>
          <input type="hidden" name="order[]" value="{{ $category->id }}">
        </li>
      @endforeach
    </ul>
    <button class="btn btn-primary">@lang('main.submit')</button>
  </form>
@endsection

@section('js')
  <script src="{{ asset('js/jquery-ui.min.js') }}" type="text/javascript"></script>
  <script>
      $(function () {
          let sortable = $("#sortable");

          sortable.sortable();
          sortable.disableSelection();
      });
  </script>
@endsection