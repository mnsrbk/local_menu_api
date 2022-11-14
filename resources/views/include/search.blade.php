  <form action="" method="GET">
    <div class="form-row">
      <div class="col-md-11 mb-3 pt-2">
        <label class="form-label" for="search"><span>@lang('main.search')</span></label>
        <input type="text" class="form-control" name="q" value="{{ request('q') }}" placeholder="Name">
      </div>
      <div class="col-md-1 mb-3 pt-5">
          <button class="btn btn-primary" type="submit"><i data-icon="search"></i></button>
      </div>
    </div>
  </form>