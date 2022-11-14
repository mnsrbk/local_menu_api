@if(count($data['tables']))
  <div class="nk-block">
    <div class="card card-bordered mb-5">
      <table class="table">
        <thead>
        <tr class="tb-tnx-head">
          <th>@lang('main.number')</th>
          @if($data['from_table'])
            <th>@lang('main.hall_name')</th>
          @endif
          <th>@lang('main.active')</th>
          <th>@lang('main.status')</th>
          <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['tables'] as $table)
          <tr class="tb-tnx-item">
            <td>{{ $table->number }}</td>
            @if($data['from_table'])
              <td>{{ $table->hall->name }}</td>
            @endif
            <td>
              @if($table->is_active)
                <span class="text-success">@lang('main.yes')</span>
              @else
                <span class="text-danger">@lang('main.no')</span>
              @endif
            </td>
            <td><span class="badge badge-dot badge-{{ config('status.' . $table->status) }}">@lang('main.' . $table->status)</span></td>
            <td class="tb-col-action">
              <span class="mr-1"><a href="{{ route('tables.show', $table->id) }}" class="link-cross link-eye mr-sm-n1"><em class="icon ni ni-eye"></em></a></span>
              <span class="mr-1"><a href="{{ route('tables.edit', $table->id) }}" class="link-cross link-edit mr-sm-n1"><em class="icon ni ni-edit-alt"></em></a></span>
              <span><a href="#" onclick="if (confirm('{{ trans("main.want_to_remove") }}')) { document.getElementById('destroy-{{ $table->id }}').submit(); }"
                       class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a></span>
              <form action="{{ route('tables.destroy', $table->id) }}" method="post" id="destroy-{{ $table->id }}">
                @method('delete')
                @csrf
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    @include('include.paginate', ['data' => ['items' => $data['tables'], 'limit' => 10]])
  </div>
@else
  <p>@lang('main.no_table')</p>
@endif