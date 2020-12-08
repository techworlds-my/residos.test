@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('unit_management_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.unit-managements.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.unitManagement.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'UnitManagement', 'route' => 'admin.unit-managements.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.unitManagement.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-UnitManagement">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.unitManagement.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.unitManagement.fields.unit') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addUnit.fields.floor') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.unitManagement.fields.owner') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.unitManagement.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.unitManagement.fields.size') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.unitManagement.fields.spa') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($unitManagements as $key => $unitManagement)
                                    <tr data-entry-id="{{ $unitManagement->id }}">
                                        <td>
                                            {{ $unitManagement->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $unitManagement->unit->unit ?? '' }}
                                        </td>
                                        <td>
                                            {{ $unitManagement->unit->floor ?? '' }}
                                        </td>
                                        <td>
                                            {{ $unitManagement->owner->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $unitManagement->owner->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\UnitManagement::STATUS_SELECT[$unitManagement->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $unitManagement->size ?? '' }}
                                        </td>
                                        <td>
                                            @if($unitManagement->spa)
                                                <a href="{{ $unitManagement->spa->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('unit_management_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.unit-managements.show', $unitManagement->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('unit_management_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.unit-managements.edit', $unitManagement->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('unit_management_delete')
                                                <form action="{{ route('frontend.unit-managements.destroy', $unitManagement->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('unit_management_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.unit-managements.massDestroy') }}",
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
  let table = $('.datatable-UnitManagement:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection