@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('facilitypayment_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.facilitypayments.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.facilitypayment.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.facilitypayment.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Facilitypayment">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.facilitypayment.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.facilitypayment.fields.amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.facilitypayment.fields.reciept') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.facilitypayment.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.facilitypayment.fields.username') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.facilitypayment.fields.payment_method') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($facilitypayments as $key => $facilitypayment)
                                    <tr data-entry-id="{{ $facilitypayment->id }}">
                                        <td>
                                            {{ $facilitypayment->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $facilitypayment->amount ?? '' }}
                                        </td>
                                        <td>
                                            @if($facilitypayment->reciept)
                                                <a href="{{ $facilitypayment->reciept->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ App\Models\Facilitypayment::STATUS_SELECT[$facilitypayment->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $facilitypayment->username->username ?? '' }}
                                        </td>
                                        <td>
                                            {{ $facilitypayment->payment_method->method ?? '' }}
                                        </td>
                                        <td>
                                            @can('facilitypayment_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.facilitypayments.show', $facilitypayment->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('facilitypayment_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.facilitypayments.edit', $facilitypayment->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('facilitypayment_delete')
                                                <form action="{{ route('frontend.facilitypayments.destroy', $facilitypayment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('facilitypayment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.facilitypayments.massDestroy') }}",
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
  let table = $('.datatable-Facilitypayment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection