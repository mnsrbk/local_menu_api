@extends('layout')

@section('title') {{ $category->name }}@endsection

@section('content')
  <div class="nk-block-head nk-block-head-lg">
    <div class="nk-block-head-sub"><span>@lang('main.category')</span></div>
    <div class="nk-block-between-md g-4">
      <div class="nk-block-head-content">
        <h2 class="nk-block-title fw-normal">{{ $category->name }}</h2>
      </div>
      <div class="nk-block-head-content">
        <ul class="nk-block-tools gx-3">
          <li>
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-white btn-dim btn-outline-primary">
              <em class="icon ni ni-edit-alt"></em><span class="d-none d-sm-inline-block">@lang('main.edit')</span>
            </a>
          </li>
          <li>
            <a href="#" class="btn btn-white btn-dim btn-outline-danger"
               onclick="if (confirm('{{ trans("main.want_to_remove") }}')) { document.getElementById('destroy-{{ $category->id }}').submit(); }">
              <em class="icon ni ni-trash"></em><span class="d-none d-sm-inline-block">@lang('main.delete')</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <form action="{{ route('categories.destroy', $category->id) }}" method="post" id="destroy-{{ $category->id }}">
    @method('delete')
    @csrf
  </form>

  <div class="card card-bordered mb-5">
    <div class="nk-data data-list">
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.image')</span>
          <span class="data-value"><img src="{{ $category->getImage() }}" alt="{{ $category->id }}" style="height: 60px"></span>
        </div>
        <div class="data-col data-col-end"><a href="{{ $category->getImage() }}" class="data-more" target="_blank"><em class="icon ni ni-forward-ios"></em></a></div>
      </div>
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.name')</span>
          <span class="data-value">
             @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
              {{ $properties['native'] }}: {{ $category->getTranslation('name', $locale) }} <br>
            @endforeach
          </span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
      @if($category->hasParent())
        <div class="data-item">
          <div class="data-col">
            <span class="data-label">@lang('main.parent_category')</span>
            <span class="data-value text-soft">{{ $category->parent->name }}</span>
          </div>
          <div class="data-col data-col-end"><a href="{{ route('categories.show', $category->parent->id) }}" class="data-more"><em class="icon ni ni-forward-ios"></em></a></div>
        </div>
      @endif
      @if($category->is_leaf)
        <div class="data-item">
          <div class="data-col">
            <span class="data-label">@lang('main.leaf')</span>
            <span class="data-value">@lang('main.yes') <span class="text-success"><em class="icon ni ni-blank"></em></span></span>
          </div>
          <div class="data-col data-col-end"></div>
        </div>
      @endif
      @if($category->is_drink)
        <div class="data-item">
          <div class="data-col">
            <span class="data-label">@lang('main.drink')</span>
            <span class="data-value">@lang('main.yes') <span class="text-success"><em class="icon ni ni-coffee"></em></span></span>
          </div>
          <div class="data-col data-col-end"></div>
        </div>
      @endif
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.food_quantity')</span>
          <span class="data-value">{{ $category->foodsCount() }}</span>
        </div>
        <div class="data-col data-col-end"><a href="#" class="data-more"><em class="icon ni ni-forward-ios"></em></a></div>
      </div>
    </div>
  </div>

  @include('include.tables.foods', ['data' => ['foods' => $foods]])
@endsection
