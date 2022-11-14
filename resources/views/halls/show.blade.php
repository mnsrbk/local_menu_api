@extends('layout')

@section('title'){{ $hall->name }}@endsection

@section('content')
  <div class="nk-block-head nk-block-head-lg mb-5">
    <div class="nk-block-head-sub"><span>@lang('main.hall')</span></div>
    <div class="nk-block-between-md g-4">
      <div class="nk-block-head-content">
        <h2 class="nk-block-title fw-normal">{{ $hall->name }}</h2>
      </div>
      <div class="nk-block-head-content">
        <ul class="nk-block-tools gx-3">
          <li>
            <a href="#" class="btn btn-white btn-dim btn-outline-primary"
               onclick="if (confirm('{{ trans("main.want_to_change_status") }}')) { document.getElementById('toggle-{{ $hall->id }}').submit(); }">
              <em class="icon ni ni-repeat"></em><span class="d-none d-sm-inline-block">@lang('main.change_status')</span>
            </a>
          </li>
          <li>
            <a href="{{ route('halls.edit', $hall->id) }}" class="btn btn-white btn-dim btn-outline-primary">
              <em class="icon ni ni-edit-alt"></em><span class="d-none d-sm-inline-block">@lang('main.edit')</span>
            </a>
          </li>
          <li>
            <a href="#" class="btn btn-white btn-dim btn-outline-danger"
               onclick="if (confirm('{{ trans("main.want_to_remove") }}')) { document.getElementById('destroy-{{ $hall->id }}').submit(); }">
              <em class="icon ni ni-trash"></em><span class="d-none d-sm-inline-block">@lang('main.delete')</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <form action="{{ route('halls.destroy', $hall->id) }}" method="post" id="destroy-{{ $hall->id }}">
    @method('delete')
    @csrf
  </form>
  <form action="{{ route('halls.toggle', $hall->id) }}" method="post" id="toggle-{{ $hall->id }}">@method('patch') @csrf</form>

  <div class="card card-bordered mb-5">
    <div class="nk-data data-list">
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.name')</span>
          <span class="data-value">
             @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
              {{ $properties['native'] }}: {{ $hall->getTranslation('name', $locale) }} <br>
            @endforeach
          </span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.is_active')</span>
          <span class="data-value">
            @if($hall->is_active)
              <span class="text-success">@lang('main.yes')</span>
            @else
              <span class="text-danger">@lang('main.no')</span>
            @endif
          </span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
    </div>
  </div>

  @include('include.tables.table', ['data' => ['tables' => $tables, 'from_table' => false]])
@endsection
