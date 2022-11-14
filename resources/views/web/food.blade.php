@extends('menu')
@section('title') @lang('main.menu') @endsection

@section('content')
<div id="food-page">
  <div class="container">
    <div id="navigation">
      <ul>
        @foreach($menu as $nav)
          @if($nav->id != $category->id)
            <li>
              <a href="{{ route('category', $nav->id) }}">{{ $nav->name }}</a>
            </li>
          @else
          <li class="active">
            <a href="{{ route('category', $category->id) }}">{{ $category->name }}</a>
          </li>
          @endif
        @endforeach
      </ul>
    </div>
    <div class="row">
      <div class="mt-2 col-12">
        <h1>{{ $food->name }}</h1>
      </div>
    </div>
    <div class="row mt-3 p-0 mx-n1 mx-md-n2">
      @foreach($food->sizes as $size)
        @if($size->id == request()->query('size'))
          <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 p-md-2 p-1">
            <a href="{{ $food->getImage() }}" target="_blank">
              <div class="mb-3">
                <img class="" src="{{ $food->getImage() }}" alt="">
                <div class="backdrop"></div>
              </div>
            </a>
            <div class="food-texts text-white mb-3">
              <p class="food-title mb-0">{{ $food->name }}<span class="float-right">{{ $size->name}}</span></p>
              @if($size->food->discount)
                <span class="text-gray old-price" style="text-decoration: line-through;">{{ price_format($size->price) }}m</span>
                <span class="price">{{ price_format($size->getDiscountPrice()) }}m</span>
              @else
                <span class="price">{{ price_format($size->price) }}m</span>
              @endif
            </div>
            @if(count($food->ingredients))
              <span class="ingredients d-block text-white pb-1 mb-1 border-bottom">@lang('main.ingredients'): </span>
              <p class="food-ingredients text-white">
                @foreach($food->ingredients as $in)
                  <span class="food-ingredient-item">{{ $in->ingredient->name }} @if($in->value){{ $in->value }}{{ $in->ingredient->unit }}@endif</span>
                @endforeach
              </p>
            @endif
          </div>
        @endif
      @endforeach
    </div>
  </div>
</div>
@endsection

@section('js')

@endsection
