@extends('layouts.admin')
@section('content')
@can('add_defect_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.add-defects.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.addDefect.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.addDefect.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AddDefect">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.addDefect.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.addDefect.fields.defect') }}
                    </th>
                    <th>
                        {{ trans('cruds.addDefect.fields.image') }}
                    </th>
                    <th>
                        {{ trans('cruds.addDefect.fields.available_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.addDefect.fields.available_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.addDefect.fields.remark') }}
                    </th>
                    <th>
                        {{ trans('cruds.addDefect.fields.username') }}
                    </th>
                    <th>
                        {{ trans('cruds.addDefect.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.addDefect.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.addDefect.fields.inchargeperson') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('add_defect_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.add-defects.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.add-defects.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'defect', name: 'defect' },
{ data: 'image', name: 'image', sortable: false, searchable: false },
{ data: 'available_date', name: 'available_date' },
{ data: 'available_time', name: 'available_time' },
{ data: 'remark', name: 'remark' },
{ data: 'username_username', name: 'username.username' },
{ data: 'category_defact_category', name: 'category.defact_category' },
{ data: 'status_status', name: 'status.status' },
{ data: 'inchargeperson_username', name: 'inchargeperson.username' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-AddDefect').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection