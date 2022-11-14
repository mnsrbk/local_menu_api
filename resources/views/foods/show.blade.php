@extends('layout')

@section('title') {{ $food->name }}@endsection

@section('content')
  <div class="nk-block-head nk-block-head-lg">
    <div class="nk-block-head-sub"><span>@lang('main.food')</span></div>
    <div class="nk-block-between-md g-4">
      <div class="nk-block-head-content">
        <h2 class="nk-block-title fw-normal">{{ $food->name }}</h2>
      </div>
      <div class="nk-block-head-content">
        <ul class="nk-block-tools gx-3">
          <li>
            <a href="{{ route('foods.ingredients.create', $food->id) }}" class="btn btn-white btn-dim btn-outline-primary">
              <em class="icon ni ni-plus-c"></em><span class="d-none d-sm-inline-block">@lang('main.ingredients')</span>
            </a>
          </li>
          <li>
            <a href="{{ route('foods.edit', $food->id) }}" class="btn btn-white btn-dim btn-outline-primary">
              <em class="icon ni ni-edit-alt"></em><span class="d-none d-sm-inline-block">@lang('main.edit')</span>
            </a>
          </li>
          <li>
            <a href="#" class="btn btn-white btn-dim btn-outline-danger"
               onclick="if (confirm('{{ trans("main.want_to_remove") }}')) { document.getElementById('destroy-{{ $food->id }}').submit(); }">
              <em class="icon ni ni-trash"></em><span class="d-none d-sm-inline-block">@lang('main.delete')</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <form action="{{ route('foods.destroy', $food->id) }}" method="post" id="destroy-{{ $food->id }}">@method('delete') @csrf</form>

  <div class="card card-bordered">
    <div class="nk-data data-list">
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.image')</span>
          <span class="data-value"><img src="{{ $food->getImage() }}" alt="{{ $food->id }}" style="height: 60px"></span>
        </div>
        <div class="data-col data-col-end"><a href="{{ $food->getImage() }}" class="data-more" target="_blank"><em class="icon ni ni-forward-ios"></em></a></div>
      </div>
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.name')</span>
          <span class="data-value">
            @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
              {{ $properties['native'] }}: {{ $food->getTranslation('name', $locale) }} <br>
            @endforeach
          </span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.category')</span>
          <span class="data-value text-soft">{{ $food->category->name }}</span>
        </div>
        <div class="data-col data-col-end"><a href="{{ route('categories.show', $food->category->id) }}" class="data-more"><em class="icon ni ni-forward-ios"></em></a></div>
      </div>
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">@lang('main.is_active')</span>
          <span class="data-value">
            @if($food->is_active)
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
          <span class="data-label">@lang('main.discount')</span>
          <span class="data-value">
            @if($food->discount) {{ $food->discount . ' ' . trans('main.' . $food->discount_unit) }} @else ― @endif
          </span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
    </div>
  </div>

  <div class="nk-block-head">
    <div class="nk-block-between-md g-4">
      <div class="nk-block-head-content">
        <h5 id="price" class="nk-block-title fw-bold">@lang('main.price')</h5>
      </div>
      <div class="nk-block-head-content">
        <ul class="nk-block-tools gx-3">
          <li>
            <a href="{{ route('foods.sizes.create', $food->id) }}" class="btn btn-white btn-dim btn-outline-primary">
              <em class="icon ni ni-plus-c"></em><span class="d-none d-sm-inline-block">@lang('main.add_price')</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  @if($food->sizes()->exists())
    <div class="card card-bordered">
      <div class="nk-data data-list">
        @foreach($food->sizes as $size)
          <div class="data-item">
            <div class="data-col">
              <span class="data-label">
                @if(empty($size->getTranslations('name')))
                  ―
                @else
                  @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
                    {{ $properties['native'] }}: {{ $size->getTranslation('name', $locale) }} <br>
                  @endforeach
                @endif
              </span>
              <span class="data-value">
                @if($size->food->discount)
                  <span style="text-decoration: line-through">{{ price_format($size->price) }} tmt</span> <br>
                  <span>{{ price_format($size->getDiscountPrice()) }} tmt</span>
                @else
                  <span>{{ price_format($size->price) }} tmt</span>
                @endif
              </span>
            </div>
            <div class="data-col data-col-end">
              <a href="{{ route('foods.sizes.edit', $size->id) }}" class="data-more"><em class="icon ni ni-edit-alt"></em></a>
              <a href="#price" class="data-more ml-3"
                 onclick="if (confirm('{{ trans("main.want_to_remove") }}')) { document.getElementById('destroy-size-{{ $size->id }}').submit(); }">
                <em class="icon ni ni-trash"></em>
              </a>
            </div>
          </div>
          <form action="{{ route('foods.sizes.destroy', $size->id) }}" method="post" id="destroy-size-{{ $size->id }}">@method('delete') @csrf</form>
        @endforeach
      </div>
    </div>
  @else
    <p>@lang('main.no_food_price')</p>
  @endif
@endsection
