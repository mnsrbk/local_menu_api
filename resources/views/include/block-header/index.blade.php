<div class="nk-block-head nk-block-head-lg">
  <div class="nk-block-head-sub"><span>@lang('main.all')</span></div>
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ $data['title'] }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        @if(Route::is('categories.index') )
           <li>
              <a href="{{ $data['route_order'] }}" class="btn btn-white btn-dim btn-outline-primary">
                <em class="icon ni ni-list"></em><span class="d-none d-sm-inline-block">@lang('main.ordering')</span>
              </a>
            </li>
          <li>
        @endif
          <a href="{{ $data['route'] }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-edit"></em><span class="d-none d-sm-inline-block">@lang('main.create_new')</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>