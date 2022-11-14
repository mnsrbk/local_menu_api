@extends('layout')

@section('title') @lang('main.tablet_password_index') @endsection

@section('content')
  @include('include.block-header.index', ['data' => ['title' => trans('main.tablet_password'), 'route' => route('passwords.create') ]])

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