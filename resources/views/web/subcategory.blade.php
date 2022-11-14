@extends('menu')
@section('title') @lang('main.menu') @endsection

@section('content')
<div id="category-page">
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
      </div>
    </div>
    <div class="row mt-3 p-0 mx-n1 mx-md-n2">
      @foreach($categories as $category)
       <div class="col-6 col-sm-6 col-md-6 col-lg-4 p-md-2 p-1">
          <a href="{{ route('category', $category->id) }}">
            <div class="category-card">
              <img class="category-image" src="{{ $category->getImage() }}" alt="">
              <div class="backdrop"></div>
              <span class="category-title">{{ $category->name }}</span>
            </div>
          </a>
       </div>
      @endforeach
    </div>
  </div>
</div>
@endsection