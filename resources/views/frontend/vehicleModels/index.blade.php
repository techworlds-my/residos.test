@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('vehicle_model_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.vehicle-models.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.vehicleModel.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'VehicleModel', 'route' => 'admin.vehicle-models.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.vehicleModel.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-VehicleModel">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleModel.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleModel.fields.modal') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleModel.fields.is_enable') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleModel.fields.brand') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleModel.fields.model') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleModel.fields.is_enable') }}
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
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\VehicleModel::IS_ENABLE_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
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
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicleModels as $key => $vehicleModel)
                                    <tr data-entry-id="{{ $vehicleModel->id }}">
                                        <td>
                                            {{ $vehicleModel->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicleModel->modal ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\VehicleModel::IS_ENABLE_SELECT[$vehicleModel->is_enable] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicleModel->brand->brand ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicleModel->model ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $vehicleModel->is_enable ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $vehicleModel->is_enable ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('vehicle_model_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.vehicle-models.show', $vehicleModel->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('vehicle_model_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.vehicle-models.edit', $vehicleModel->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('vehicle_model_delete')
                                                <form action="{{ route('frontend.vehicle-models.destroy', $vehicleModel->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('vehicle_model_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.vehicle-models.massDestroy') }}",
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
  let table = $('.datatable-VehicleModel:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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