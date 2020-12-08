@extends('layouts.admin')
@section('content')
@can('maintenances_payment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.maintenances-payments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.maintenancesPayment.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.maintenancesPayment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-MaintenancesPayment">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.maintenancesPayment.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenancesPayment.fields.amount') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenancesPayment.fields.month') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenancesPayment.fields.receipt') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenancesPayment.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenancesPayment.fields.username') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenancesPayment.fields.payment_method') }}
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
@can('maintenances_payment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.maintenances-payments.massDestroy') }}",
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
    ajax: "{{ route('admin.maintenances-payments.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'amount', name: 'amount' },
{ data: 'month', name: 'month' },
{ data: 'receipt', name: 'receipt', sortable: false, searchable: false },
{ data: 'status', name: 'status' },
{ data: 'username_username', name: 'username.username' },
{ data: 'payment_method_method', name: 'payment_method.method' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-MaintenancesPayment').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection