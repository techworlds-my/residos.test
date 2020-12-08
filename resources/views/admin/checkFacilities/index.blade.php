@extends('layouts.admin')
@section('content')
@can('check_facility_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.check-facilities.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.checkFacility.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.checkFacility.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-CheckFacility">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.checkFacility.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.checkFacility.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.checkFacility.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.checkFacility.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.checkFacility.fields.image') }}
                    </th>
                    <th>
                        {{ trans('cruds.checkFacility.fields.date_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.checkFacility.fields.facility') }}
                    </th>
                    <th>
                        {{ trans('cruds.checkFacility.fields.defect') }}
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
@can('check_facility_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.check-facilities.massDestroy') }}",
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
    ajax: "{{ route('admin.check-facilities.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'user_name', name: 'user.name' },
{ data: 'status', name: 'status' },
{ data: 'description', name: 'description' },
{ data: 'image', name: 'image', sortable: false, searchable: false },
{ data: 'date_time', name: 'date_time' },
{ data: 'facility_name', name: 'facility.name' },
{ data: 'defect_defact_category', name: 'defect.defact_category' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-CheckFacility').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection