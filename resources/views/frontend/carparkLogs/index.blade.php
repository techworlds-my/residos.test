@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('carpark_log_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.carpark-logs.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.carparkLog.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.carparkLog.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-CarparkLog">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carparkLog.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.carparkLog.fields.time_in') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.carparkLog.fields.time_out') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.carparkLog.fields.price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.carparkLog.fields.carplate') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.carparkLog.fields.location') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carparkLogs as $key => $carparkLog)
                                    <tr data-entry-id="{{ $carparkLog->id }}">
                                        <td>
                                            {{ $carparkLog->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $carparkLog->time_in ?? '' }}
                                        </td>
                                        <td>
                                            {{ $carparkLog->time_out ?? '' }}
                                        </td>
                                        <td>
                                            {{ $carparkLog->price ?? '' }}
                                        </td>
                                        <td>
                                            {{ $carparkLog->carplate->car_plate ?? '' }}
                                        </td>
                                        <td>
                                            {{ $carparkLog->location->location ?? '' }}
                                        </td>
                                        <td>
                                            @can('carpark_log_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.carpark-logs.show', $carparkLog->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('carpark_log_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.carpark-logs.edit', $carparkLog->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('carpark_log_delete')
                                                <form action="{{ route('frontend.carpark-logs.destroy', $carparkLog->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('carpark_log_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.carpark-logs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-CarparkLog:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection