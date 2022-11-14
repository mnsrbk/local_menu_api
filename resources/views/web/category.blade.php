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
        <h1>{{ $category->name }}</h1>
        <!-- <a href="{{ route('home') }}">@lang('main.categories')</a> -->
        <!-- <span>{{ $category->name }}</span> -->
      </div>
    </div>
    <div class="foods-contianer row mt-3 p-0 mx-n1 mx-md-n2">
      @foreach($foods as $food)
        @if($category->is_drink)
          @foreach($food->sizes as $size)
            <div class="food-wrapper col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 p-md-2 p-1">
              <a href="{{ route('food', ['category' => $category->id, 'food' => $food->id, 'size' => $size->id]) }}">
                <div class="food-card is-drink mb-md-3">
                  <img class="category-image" src="{{ $food->getImage() }}" alt="">
                  <div class="backdrop"></div>
                  <div class="food-texts">
                    <p class="food-title">{{ $food->name }}</p>
                    <span class="float-left">{{ $size->name}}</span>
                    @if($size->food->discount)
                      <span class="old-price">{{ price_format($size->price) }} m</span>
                      <span>{{ price_format($size->getDiscountPrice()) }} m</span>
                    @else
                      <span class="price">{{ price_format($size->price) }} m</span>
                    @endif
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        @else
          @foreach($food->sizes as $size)
            <div class="food-wrapper col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 p-md-2 p-1">
              <a href="{{ route('food', ['category' => $category->id, 'food' => $food->id, 'size' => $size->id]) }}">
                <div class="food-card">
                  <img class="category-image" src="{{ $food->getImage() }}" alt="">
                  <div class="backdrop"></div>
                  <div class="food-texts">
                    <p class="food-title">{{ $food->name }}</p>
                    <span class="float-left" style="font-weight: 400;">{{ $size->name}}</span>
                    @if($size->food->discount)
                      <span class="old-price">{{ price_format($size->price) }}m</span>
                      <span class="price">{{ price_format($size->getDiscountPrice()) }}m</span>
                    @else
                      <span class="price">{{ price_format($size->price) }}m</span>
                    @endif
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        @endif
      @endforeach
    </div>
  </div>
</div>
@endsection

@section('js')

@endsection