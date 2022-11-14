@if(count($data['foods']))
  <div class="nk-block">
    <div class="card card-bordered mb-5">
      <table class="table">
        <thead>
        <tr class="tb-tnx-head">
          @foreach(LaravelLocalization::getSupportedLocales() as $properties)
            <th>{{ $properties['native'] }}</th>
          @endforeach
          <th>@lang('main.category')</th>
          <th>@lang('main.active')</th>
          <th>@lang('main.discount')</th>
          <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['foods'] as $food)
          <tr class="tb-tnx-item">
            @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
              <td>{{ $food->getTranslation('name', $locale) }}</td>
            @endforeach
            <td>{{ $food->category->name }}</td>
            <td>
              @if($food->is_active)
                <span class="text-success">@lang('main.yes')</span>
              @else
                <span class="text-danger">@lang('main.no')</span>
              @endif
            </td>
            <td>@if($food->discount) {{ $food->discount . ' ' . trans('main.' . $food->discount_unit) }} @else ― @endif</td>
            <td class="tb-col-action">
              <span class="mr-1"><a href="{{ route('foods.show', $food->id) }}" class="link-cross link-eye mr-sm-n1"><em class="icon ni ni-eye"></em></a></span>
              <span class="mr-1"><a href="{{ route('foods.edit', $food->id) }}" class="link-cross link-edit mr-sm-n1"><em class="icon ni ni-edit-alt"></em></a></span>
              <span><a href="#" onclick="if (confirm('{{ trans("main.want_to_remove") }}')) { document.getElementById('destroy-{{ $food->id }}').submit(); }"
                       class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a></span>
              <form action="{{ route('foods.destroy', $food->id) }}" method="post" id="destroy-{{ $food->id }}">
                @method('delete')
                @csrf
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    @include('include.paginate', ['data' => ['items' => $data['foods'], 'limit' => 10]])
  </div>
@else
  <p>@lang('main.no_food')</p>
@endif