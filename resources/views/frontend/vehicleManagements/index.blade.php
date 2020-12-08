@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('vehicle_management_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.vehicle-managements.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.vehicleManagement.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'VehicleManagement', 'route' => 'admin.vehicle-managements.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.vehicleManagement.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-VehicleManagement">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleManagement.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleManagement.fields.username') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleManagement.fields.car_plate') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleManagement.fields.is_verify') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleManagement.fields.brand') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleManagement.fields.modal') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleManagement.fields.color') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleManagement.fields.is_season_park') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleManagement.fields.dirver_count') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleManagement.fields.is_resident') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($users as $key => $item)
                                                <option value="{{ $item->username }}">{{ $item->username }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($vehicle_brands as $key => $item)
                                                <option value="{{ $item->brand }}">{{ $item->brand }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicleManagements as $key => $vehicleManagement)
                                    <tr data-entry-id="{{ $vehicleManagement->id }}">
                                        <td>
                                            {{ $vehicleManagement->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicleManagement->username->username ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicleManagement->car_plate ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $vehicleManagement->is_verify ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $vehicleManagement->is_verify ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $vehicleManagement->brand->brand ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicleManagement->modal ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicleManagement->color ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $vehicleManagement->is_season_park ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $vehicleManagement->is_season_park ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $vehicleManagement->dirver_count ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $vehicleManagement->is_resident ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $vehicleManagement->is_resident ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('vehicle_management_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.vehicle-managements.show', $vehicleManagement->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('vehicle_management_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.vehicle-managements.edit', $vehicleManagement->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('vehicle_management_delete')
                                                <form action="{{ route('frontend.vehicle-managements.destroy', $vehicleManagement->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('vehicle_management_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.vehicle-managements.massDestroy') }}",
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
  let table = $('.datatable-VehicleManagement:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection