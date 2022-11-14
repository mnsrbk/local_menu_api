@extends('layout')

@section('title') @lang('main.hall_index') @endsection

@section('content')
  @include('include.block-header.index', ['data' => ['title' => trans('main.halls'), 'route' => route('halls.create') ]])
  @include('include.search')
  @if(count($halls))
    <div class="nk-block">
      <div class="card card-bordered mb-5">
        <table class="table">
          <thead>
          <tr class="tb-tnx-head">
            @foreach(LaravelLocalization::getSupportedLocales() as $properties)
              <th>{{ $properties['native'] }}</th>
            @endforeach
            <th>@lang('main.active')</th>
            <th>@lang('main.num_of_tables')</th>
            <th>&nbsp;</th>
          </tr>
          </thead>
          <tbody>
          @foreach($halls as $hall)
            <tr class="tb-tnx-item">
              @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
                <td>{{ $hall->getTranslation('name', $locale) }}</td>
              @endforeach
              <td>
                @if($hall->is_active)
                  <span class="text-success">@lang('main.yes')</span>
                @else
                  <span class="text-danger">@lang('main.no')</span>
                @endif
              </td>
              <td>{{ $hall->tables()->count() }}</td>
              <td class="tb-col-action">
                <span class="mr-1"><a href="{{ route('halls.show', $hall->id) }}" class="link-cross link-eye mr-sm-n1"><em class="icon ni ni-eye"></em></a></span>
                <span class="mr-1"><a href="{{ route('halls.edit', $hall->id) }}" class="link-cross link-edit mr-sm-n1"><em class="icon ni ni-edit-alt"></em></a></span>
                <span><a href="#" onclick="if (confirm('{{ trans("main.want_to_remove") }}')) { document.getElementById('destroy-{{ $hall->id }}').submit(); }"
                         class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a></span>
                <form action="{{ route('halls.destroy', $hall->id) }}" method="post" id="destroy-{{ $hall->id }}">
                  @method('delete')
                  @csrf
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>

      @include('include.paginate', ['data' => ['items' => $halls, 'limit' => 10]])
    </div>
  @else
    <p>@lang('main.no_hall')</p>
  @endif
@endsection