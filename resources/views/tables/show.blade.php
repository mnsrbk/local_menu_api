@extends('layout')

@section('title')@lang('main.table_number') {{ $table->number }}@endsection

@section('content')
  <div class="nk-block-head nk-block-head-lg mb-5">
    <div class="nk-block-head-sub"><span>@lang('main.table_number')</span></div>
    <div class="nk-block-between-md g-4">
      <div class="nk-block-head-content">
        <h2 class="nk-block-title fw-normal">{{ $table->number }}</h2>
      </div>
      <div class="nk-block-head-content">
        <ul class="nk-block-tools gx-3">
          <li>
            <a href="#" class="btn btn-white btn-dim btn-outline-primary"
               onclick="if (confirm('{{ trans("main.want_to_change_status") }}')) { document.getElementById('toggle-{{ $table->id }}').submit(); }">
              <em class="icon ni ni-repeat"></em><span class="d-none d-sm-inline-block">@lang('main.change_status')</span>
            </a>
          </li>
          <li>
            <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-white btn-dim btn-outline-primary">
              <em class="icon ni ni-edit-alt"></em><span class="d-none d-sm-inline-block">@lang('main.edit')</span>
            </a>
          </li>
          <li>
            <a href="#" class="btn btn-white btn-dim btn-outline-danger"
               onclick="if (confirm('{{ trans("main.want_to_remove") }}')) { document.getElementById('destroy-{{ $table->id }}').submit(); }">
              <em class="icon ni ni-trash"></em><span class="d-none d-sm-inline-block">@lang('main.delete')</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <form action="{{ route('tables.destroy', $table->id) }}" method="post" id="destroy-{{ $table->id }}">
    @method('delete')
    @csrf
  </form>
  <form action="{{ route('tables.toggle', $table->id) }}" method="post" id="toggle-{{ $table->id }}">@method('patch') @csrf</form>

  <div class="card card-bordered mb-5">
    <div class="nk-data data-list">
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.number')</span>
          <span class="data-value">{{ $table->number }}</span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.is_active')</span>
          <span class="data-value">
            @if($table->is_active)
              <span class="text-success">@lang('main.yes')</span>
            @else
              <span class="text-danger">@lang('main.no')</span>
            @endif
          </span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.status')</span>
          <span class="data-value"><span class="badge badge-dot badge-{{ config('status.' . $table->status) }}">@lang('main.' . $table->status)</span></span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.hall')</span>
          <span class="data-value">{{ $table->hall->name }}</span>
        </div>
        <div class="data-col data-col-end"><a href="{{ route('halls.show', $table->hall->id) }}" class="data-more"><em class="icon ni ni-forward-ios"></em></a></div>
      </div>
    </div>
  </div>
@endsection
