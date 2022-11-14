@extends('layout')

@section('title') @lang('main.order_index') @endsection

<link rel="stylesheet" href="{{ asset('css/datepicker.min.css') }}">

@section('content')
  <div class="nk-block-head nk-block-head-lg">
    <div class="nk-block-head-sub"><span>@lang('main.all')</span></div>
    <div class="nk-block-between-md g-4">
      <div class="nk-block-head-content">
        <h2 class="nk-block-title fw-normal">@lang('main.orders')</h2>
      </div>
    </div>
  </div>
  <form action="" method="GET">
    <div class="form-row">
      <div class="col-md col-sm-6 mb-3 pt-2">
        <label class="form-label" for="search"><span>@lang('main.search')</span></label>
        <input type="text" class="form-control" name="q" value="{{ request('q') }}" placeholder="Kod">
      </div>
      <div class="col-md col-sm-6 mb-3 pt-2">
        <label class="form-label" for="search"><span>@lang('main.hall')</span></label>
        <select class="select" id="halls" name="halls[]" multiple="multiple">
        @foreach ($halls as $hall)
          <option value="{{ $hall->id }}" @if (in_array($hall->id, request('halls', []))) selected
                  @endif>{{ $hall->name }}</option>
        @endforeach
      </select>
      </div>
      <div class="col-md col-sm-6 mb-3 pt-2">
        <label class="form-label" for="search"><span>@lang('main.status')</span></label>
        <select class="select" id="status" name="statuses[]" multiple="multiple" placeholder="Status">
                <option value="bill-taken" @if (in_array('1', $bill)) selected @endif>@lang('main.bill_taken')</option>
                <option value="bill-not-taken" @if (in_array('0', $bill)) selected @endif>@lang('main.bill_not_taken')</option>
                <option value="paid" @if (in_array('1', $paid)) selected @endif>@lang('main._paid')</option>
                <option value="not-paid" @if (in_array('0', $paid)) selected @endif>@lang('main.not_paid')</option>
        </select>
      </div>
      <div class="col-md col-sm-6 mb-3 pt-2">
        <label class="form-label" for="search"><span>@lang('main.date')</span></label>
       <div id="date-form" class="form-group">
        <input type="text" name="date-range" id="date-range" class="form-control date-pick" value="{{ request('date-range') }}" autocomplete="off">
      </div>
      </div>
      <div class="col-auto mb-3 pt-5">
          <button class="btn btn-primary" type="submit"><i data-icon="search"></i></button>
      </div>
    </div>
  </form>
  @if(count($orders))
    <div class="nk-block">
      <div class="card card-bordered mb-5">
        <table class="table">
          <thead>
          <tr class="tb-tnx-head">
            <th>@lang('main.code')</th>
            <th>@lang('main.hall_table')</th>
            <th>@lang('main.total_cost')</th>
            <th>@lang('main.order_date')</th>
            <th>@lang('main.bill_taken')</th>
            <th>@lang('main.paid')</th>
            <th>&nbsp;</th>
          </tr>
          </thead>
          <tbody>
          @foreach($orders as $order)
            <tr class="tb-tnx-item">
              <td>#{{ $order->code }}</td>
              <td>{{ $order->table()->exists() ? $order->table->hall->name . '/' . $order->table->number : '-' }}</td>
              <td>{{ price_format($order->total_cost) }} @lang('main.manat')</td>
              <td>{{ date('H:i/d.m.Y', strtotime($order->created_at)) }}</td>
              <td class="tb-col-action text-center">
                @if($order->bill_taken)
                  <span title="@lang('main.bill_taken')" class="text-primary"><em class="icon ni ni-done"></em></span>
                @else
                  <a href="#" onclick="if (confirm('{{ trans('main.is_bill_taken') }}')) { document.getElementById('is-bill-taken-order-{{ $order->id }}').submit(); }"
                     class="link-cross link-eye mr-sm-n1" title="@lang('main.bill_taken')"><em class="icon ni ni-invest"></em></a>
                  <form action="{{ route('orders.update', $order->id) }}" method="post" id="is-bill-taken-order-{{ $order->id }}" class="d-none">
                    @method('patch')
                    @csrf
                    <input type="hidden" name="bill_taken" value="1">
                  </form>
                @endif
              </td>
              <td class="tb-col-action text-center">
                @if($order->is_paid)
                  <span title="@lang('main.paid')" class="text-primary"><em class="icon ni ni-done"></em></span>
                @else
                  <a href="#" onclick="if (confirm('{{ trans('main.is_paid') }}')) { document.getElementById('is-paid-order-{{ $order->id }}').submit(); }"
                     class="link-cross link-eye mr-sm-n1" title="@lang('main.paid')"><em class="icon ni ni-money"></em></a>
                  <form action="{{ route('orders.update', $order->id) }}" method="post" id="is-paid-order-{{ $order->id }}" class="d-none">
                    @method('patch')
                    @csrf
                    <input type="hidden" name="is_paid" value="1">
                  </form>
                @endif
              </td>
              <td class="tb-col-action">
                <a href="{{ route('orders.show', $order->id) }}" class="link-cross link-eye mr-sm-n1"><em class="icon ni ni-eye"></em></a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      @include('include.paginate', ['data' => ['items' => $orders, 'limit' => 15]])
    </div>
  @else
    <p>@lang('main.no_orders')</p>
  @endif
@endsection
  @section('js')
    <script src="{{ asset('js/datepicker.min.js') }}"></script>
    <script>
        $(function() {
            $('.select').select2({
                width: '100%',
                minimumResultsForSearch: -1
            });
        });
        $(function () {
          $('.date-pick').datepicker({
            language: 'tk',
            range: true,
            multipleDatesSeparator: " - ",
            dateFormat: 'dd.mm.yyyy',
            autoClose: true,
          });
        });

    </script>
@endsection