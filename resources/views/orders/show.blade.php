@extends('layout')

@section('title')#{{ $order->code }} @lang('main.order_details') @endsection

@section('content')
  <div class="nk-block-head nk-block-head-lg">
    <div class="nk-block-head-sub"><span>@lang('main.order_details')</span></div>
    <div class="nk-block-between-md g-4">
      <div class="nk-block-head-content">
        <h2 class="nk-block-title fw-normal">#{{ $order->code }}</h2>
      </div>
      @if(!$order->bill_taken || !$order->is_paid)
        <div class="nk-block-head-content">
          <ul class="nk-block-tools gx-3">
            @if(!$order->bill_taken)
              <li>
                <a href="#" class="btn btn-white btn-dim btn-outline-primary"
                   onclick="if (confirm('{{ trans("main.is_bill_taken") }}')) { document.getElementById('is-bill-taken-order-{{ $order->id }}').submit(); }">
                  <em class="icon ni ni-invest"></em><span class="d-none d-sm-inline-block">@lang('main.bill_taken')</span>
                </a>
                <form action="{{ route('orders.update', $order->id) }}" method="post" id="is-bill-taken-order-{{ $order->id }}" class="d-none">
                  @method('patch')
                  @csrf
                  <input type="hidden" name="bill_taken" value="1">
                </form>
              </li>
            @endif
            @if(!$order->is_paid)
              <li>
                <a href="#" class="btn btn-white btn-dim btn-outline-primary"
                   onclick="if (confirm('{{ trans("main.is_paid") }}')) { document.getElementById('is-paid-order-{{ $order->id }}').submit(); }">
                  <em class="icon ni ni-money"></em><span class="d-none d-sm-inline-block">@lang('main.is_paid')</span>
                </a>
                <form action="{{ route('orders.update', $order->id) }}" method="post" id="is-paid-order-{{ $order->id }}" class="d-none">
                  @method('patch')
                  @csrf
                  <input type="hidden" name="is_paid" value="1">
                </form>
              </li>
            @endif
          </ul>
        </div>
      @endif
    </div>
  </div>
  <div class="card card-bordered mb-5">
    <div class="nk-data data-list">
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.code')</span>
          <span class="data-value">#{{ $order->code }}</span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
      @if($order->table()->exists())
        <div class="data-item">
          <div class="data-col">
            <span class="data-label">@lang('main.hall_table')</span>
            <span class="data-value">{{ $order->table->hall->name . '/' . $order->table->number }}</span>
          </div>
          <div class="data-col data-col-end"></div>
        </div>
      @endif
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.cost')</span>
          <span class="data-value">{{ price_format($order->cost) }} @lang('main.manat')</span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.service_cost')</span>
          <span class="data-value">{{ price_format($order->service_cost) }} @lang('main.manat')</span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.total_cost')</span>
          <span class="data-value">{{ price_format($order->total_cost) }} @lang('main.manat')</span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.order_date')</span>
          <span class="data-value">{{ date('H:i/d.m.Y', strtotime($order->created_at)) }}</span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.bill_taken')</span>
          <span class="data-value">
            @if($order->bill_taken)
              <span title="@lang('main.bill_taken')" class="text-primary"><em class="icon ni ni-done"></em></span>
            @else
              <span class="text-danger">@lang('main.no')</span>
            @endif
          </span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.is_paid')</span>
          <span class="data-value">
            @if($order->is_paid)
              <span title="@lang('main.is_paid')" class="text-primary"><em class="icon ni ni-done"></em></span>
            @else
              <span class="text-danger">@lang('main.no')</span>
            @endif
          </span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
    </div>
  </div>
  <h5 class="title mb-3">@lang('main.ordered_foods')</h5>
  <div class="nk-block">
    <div class="card card-bordered mb-5">
      <table class="table">
        <thead>
        <tr class="tb-tnx-head">
          <th>@lang('main.name')</th>
          <th>@lang('main.category')</th>
          <th>@lang('main.quantity')</th>
          <th>@lang('main.price')</th>
          <th>@lang('main.discount')</th>
          <th>@lang('main.total_cost')</th>
          <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($order->items as $item)
          <tr class="tb-tnx-item">
            <td>{{ $item->food->name }}</td>
            <td>{{ $item->food->category->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ price_format($item->cost) }} tmt</td>
            <td>@if($item->discount){{ price_format($item->discount) }} tmt @endif</td>
            <td>{{ price_format($item->total_cost * $item->quantity) }} tmt</td>
            <td class="tb-col-action"><a href="{{ route('foods.show', $item->item_id) }}" class="link-cross link-eye mr-sm-n1"><em class="icon ni ni-eye"></em></a></td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection