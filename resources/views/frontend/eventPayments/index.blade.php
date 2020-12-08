@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('event_payment_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.event-payments.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.eventPayment.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.eventPayment.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-EventPayment">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventPayment.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventPayment.fields.payment') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventPayment.fields.payment_method') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventPayment.fields.username') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventPayment.fields.event') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($eventPayments as $key => $eventPayment)
                                    <tr data-entry-id="{{ $eventPayment->id }}">
                                        <td>
                                            {{ $eventPayment->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventPayment->payment ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventPayment->payment_method ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventPayment->username->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventPayment->event->title ?? '' }}
                                        </td>
                                        <td>
                                            @can('event_payment_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.event-payments.show', $eventPayment->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('event_payment_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.event-payments.edit', $eventPayment->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('event_payment_delete')
                                                <form action="{{ route('frontend.event-payments.destroy', $eventPayment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('event_payment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.event-payments.massDestroy') }}",
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
  let table = $('.datatable-EventPayment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection