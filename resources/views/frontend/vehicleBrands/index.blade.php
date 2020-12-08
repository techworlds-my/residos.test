@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('vehicle_brand_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.vehicle-brands.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.vehicleBrand.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'VehicleBrand', 'route' => 'admin.vehicle-brands.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.vehicleBrand.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-VehicleBrand">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.vehicleBrand.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleBrand.fields.brand') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.vehicleBrand.fields.is_enable') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicleBrands as $key => $vehicleBrand)
                                    <tr data-entry-id="{{ $vehicleBrand->id }}">
                                        <td>
                                            {{ $vehicleBrand->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $vehicleBrand->brand ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $vehicleBrand->is_enable ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $vehicleBrand->is_enable ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('vehicle_brand_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.vehicle-brands.show', $vehicleBrand->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('vehicle_brand_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.vehicle-brands.edit', $vehicleBrand->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('vehicle_brand_delete')
                                                <form action="{{ route('frontend.vehicle-brands.destroy', $vehicleBrand->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('vehicle_brand_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.vehicle-brands.massDestroy') }}",
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
  let table = $('.datatable-VehicleBrand:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection