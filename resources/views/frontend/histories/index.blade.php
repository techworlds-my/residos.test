@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('history_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.histories.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.history.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.history.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-History">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.history.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.history.fields.qr') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.history.fields.type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.history.fields.username') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.history.fields.entrance') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($histories as $key => $history)
                                    <tr data-entry-id="{{ $history->id }}">
                                        <td>
                                            {{ $history->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $history->qr ?? '' }}
                                        </td>
                                        <td>
                                            {{ $history->type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $history->username->username ?? '' }}
                                        </td>
                                        <td>
                                            {{ $history->entrance->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('history_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.histories.show', $history->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('history_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.histories.edit', $history->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('history_delete')
                                                <form action="{{ route('frontend.histories.destroy', $history->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('history_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.histories.massDestroy') }}",
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
  let table = $('.datatable-History:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection