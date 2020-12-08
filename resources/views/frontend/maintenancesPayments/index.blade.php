@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('maintenances_payment_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.maintenances-payments.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-MaintenancesPayment">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($maintenancesPayments as $key => $maintenancesPayment)
                                    <tr data-entry-id="{{ $maintenancesPayment->id }}">
                                        <td>
                                            {{ $maintenancesPayment->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $maintenancesPayment->amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $maintenancesPayment->month ?? '' }}
                                        </td>
                                        <td>
                                            @if($maintenancesPayment->receipt)
                                                <a href="{{ $maintenancesPayment->receipt->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ App\Models\MaintenancesPayment::STATUS_SELECT[$maintenancesPayment->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $maintenancesPayment->username->username ?? '' }}
                                        </td>
                                        <td>
                                            {{ $maintenancesPayment->payment_method->method ?? '' }}
                                        </td>
                                        <td>
                                            @can('maintenances_payment_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.maintenances-payments.show', $maintenancesPayment->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('maintenances_payment_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.maintenances-payments.edit', $maintenancesPayment->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('maintenances_payment_delete')
                                                <form action="{{ route('frontend.maintenances-payments.destroy', $maintenancesPayment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('maintenances_payment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.maintenances-payments.massDestroy') }}",
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
  let table = $('.datatable-MaintenancesPayment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection