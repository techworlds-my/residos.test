@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('event_control_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.event-controls.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.eventControl.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.eventControl.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-EventControl">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventControl.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventControl.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventControl.fields.date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventControl.fields.time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventControl.fields.payment') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventControl.fields.participants') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventControl.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventControl.fields.image') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventControl.fields.category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventControl.fields.audience_group') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($eventControls as $key => $eventControl)
                                    <tr data-entry-id="{{ $eventControl->id }}">
                                        <td>
                                            {{ $eventControl->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventControl->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventControl->date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventControl->time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventControl->payment ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventControl->participants ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventControl->status ?? '' }}
                                        </td>
                                        <td>
                                            @if($eventControl->image)
                                                <a href="{{ $eventControl->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $eventControl->image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $eventControl->category->cateogey ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventControl->audience_group->title ?? '' }}
                                        </td>
                                        <td>
                                            @can('event_control_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.event-controls.show', $eventControl->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('event_control_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.event-controls.edit', $eventControl->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('event_control_delete')
                                                <form action="{{ route('frontend.event-controls.destroy', $eventControl->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('event_control_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.event-controls.massDestroy') }}",
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
  let table = $('.datatable-EventControl:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection