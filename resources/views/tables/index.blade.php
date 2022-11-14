@extends('layout')

@section('title') @lang('main.table_index') @endsection

@section('content')
  @include('include.block-header.index', ['data' => ['title' => trans('main.tables'), 'route' => route('tables.create') ]])
    <form action="" method="GET">
    <div class="form-row">
      <div class="col-md-5 mb-3 pt-2">
        <label class="form-label" for="search"><span>@lang('main.search')</span></label>
        <input type="text" class="form-control" name="q" value="{{ request('q') }}">
      </div>
      <div class="col-md-3 mb-3 pt-2">
        <label class="form-label" for="search"><span>@lang('main.hall')</span></label>
        <select class="select" id="halls" name="halls[]" multiple="multiple">
        @foreach ($halls as $hall)
          <option value="{{ $hall->id }}" @if (in_array($hall->id, request('halls', []))) selected
                  @endif>{{ $hall->name }}</option>
        @endforeach
      </select>
      </div>
      <div class="col-md-3 mb-3 pt-2">
        <label class="form-label" for="search"><span>@lang('main.status')</span></label>
        <select class="select" id="status" name="statuses[]" multiple="multiple" placeholder="Status">
                <option value="empty" @if (in_array('empty', request('statuses', []))) selected @endif>@lang('main.empty')</option>
                <option value="not_empty" @if (in_array('not_empty', request('statuses', []))) selected @endif>@lang('main.not_empty')</option>
        </select>
      </div>
      <div class="col-md-1 mb-3 pt-5">
          <button class="btn btn-primary" type="submit"><i data-icon="search"></i></button>
      </div>
    </div>
  </form>
  @include('include.tables.table', ['data' => ['tables' => $tables, 'from_table' => true]])
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