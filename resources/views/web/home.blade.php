@extends('menu')
@section('title') @lang('main.menu') @endsection

@section('content')
<div id="home-page">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <span class="nk-menu-icon"><em class="icon ni ni-folder-list"></em></span>
        <h1>@lang('main.categories')</h1>
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