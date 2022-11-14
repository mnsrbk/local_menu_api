@extends('layout')

@section('title') @lang('main.restaurant_settings') @endsection

@section('content')
  <div class="nk-block-head">
    <div class="nk-block-head-content">
      <div class="nk-block-head-sub"><span>@lang('main.settings')</span></div>
      <h2 class="nk-block-title fw-normal">@lang('main.restaurant')</h2>
    </div>
  </div>

  <div class="nk-block-head">
    <div class="nk-block-between-md g-4">
      <div class="nk-block-head-content">
        <h5 class="nk-block-title fw-bold">@lang('main.service_cost')</h5>
      </div>
      <div class="nk-block-head-content">
        <ul class="nk-block-tools gx-3">
          <li>
            @if(empty($service))
              <a href="{{ route('services.create') }}" class="btn btn-white btn-dim btn-outline-primary">
                <em class="icon ni ni-plus-c"></em><span class="d-none d-sm-inline-block">@lang('main.create_new')</span>
              </a>
            @else
              <a href="{{ route('services.edit', $service->id) }}" class="btn btn-white btn-dim btn-outline-primary">
                <em class="icon ni ni-edit-alt"></em><span class="d-none d-sm-inline-block">@lang('main.edit')</span>
              </a>
            @endif
          </li>
        </ul>
      </div>
    </div>
  </div>
  @if(!empty($service))
    <div class="card card-bordered">
      <div class="nk-data data-list">
        <div class="data-item">
          <div class="data-col">
            <span class="data-label">@lang('main.' . $service->name)</span>
            <span class="data-value">{{ $service->getCost() }} @lang('main.' . $service->unit)</span>
          </div>
          <div class="data-col data-col-end"></div>
        </div>
      </div>
    </div>
  @else
    <p class="mb-5">@lang('main.no_service_cost')</p>
  @endif

  <div class="nk-block-head">
    <div class="nk-block-between-md g-4">
      <div class="nk-block-head-content">
        <h5 class="nk-block-title fw-bold">@lang('main.tablet_password')</h5>
      </div>
      <div class="nk-block-head-content">
        <ul class="nk-block-tools gx-3">
          <li>
            <a href="{{ route('passwords.create') }}" class="btn btn-white btn-dim btn-outline-primary">
              <em class="icon ni ni-plus-c"></em><span class="d-none d-sm-inline-block">@lang('main.create_new')</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  @if(!empty($current))
    <div class="card card-bordered">
      <div class="nk-data data-list">
        <div class="data-item">
          <div class="data-col">
            <span class="data-label">@lang('main.current_password')</span>
            <span class="data-value">{{ $current->code }}</span>
          </div>
          <div class="data-col data-col-end"></div>
        </div>
      </div>
    </div>
  @else
    <p>@lang('main.no_password')</p>
  @endif

  @if(count($passwords))
    <div class="nk-block-head">
      <div class="nk-block-between-md g-4">
        <div class="nk-block-head-content">
          <h5 id="price" class="nk-block-title fw-bold">@lang('main.password_history')</h5>
        </div>
        <div class="nk-block-head-content">
          <ul class="nk-block-tools gx-3">
            <li>
              <a href="#" class="btn btn-white btn-dim btn-outline-danger"
                 onclick="if (confirm('{{ trans("main.lost_every_history_data") }}')) { document.getElementById('destroy-history').submit(); }">
                <em class="icon ni ni-trash-alt"></em><span class="d-none d-sm-inline-block">@lang('main.clear_history')</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <form action="{{ route('passwords.destroy') }}" method="post" id="destroy-history">@method('delete') @csrf</form>
    <div class="nk-block">
      <div class="card card-bordered mb-5">
        <table class="table">
          <tbody>
          @foreach($passwords as $password)
            <tr class="tb-tnx-item">
              <td>{{ $password->code }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @endif
@endsection