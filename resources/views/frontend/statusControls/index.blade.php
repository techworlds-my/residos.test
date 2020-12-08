@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('status_control_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.status-controls.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.statusControl.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'StatusControl', 'route' => 'admin.status-controls.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.statusControl.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-StatusControl">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.statusControl.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.statusControl.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.statusControl.fields.desctiption') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.statusControl.fields.in_enable') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($statusControls as $key => $statusControl)
                                    <tr data-entry-id="{{ $statusControl->id }}">
                                        <td>
                                            {{ $statusControl->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $statusControl->status ?? '' }}
                                        </td>
                                        <td>
                                            {{ $statusControl->desctiption ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $statusControl->in_enable ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $statusControl->in_enable ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('status_control_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.status-controls.show', $statusControl->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('status_control_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.status-controls.edit', $statusControl->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('status_control_delete')
                                                <form action="{{ route('frontend.status-controls.destroy', $statusControl->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('status_control_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.status-controls.massDestroy') }}",
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
  let table = $('.datatable-StatusControl:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection