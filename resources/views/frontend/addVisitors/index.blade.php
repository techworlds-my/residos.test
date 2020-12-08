@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('add_visitor_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.add-visitors.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.addVisitor.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.addVisitor.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-AddVisitor">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addVisitor.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addVisitor.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addVisitor.fields.username') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addVisitor.fields.add_by') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($addVisitors as $key => $addVisitor)
                                    <tr data-entry-id="{{ $addVisitor->id }}">
                                        <td>
                                            {{ $addVisitor->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\AddVisitor::STATUS_SELECT[$addVisitor->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addVisitor->username->username ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addVisitor->add_by->username ?? '' }}
                                        </td>
                                        <td>
                                            @can('add_visitor_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.add-visitors.show', $addVisitor->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('add_visitor_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.add-visitors.edit', $addVisitor->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('add_visitor_delete')
                                                <form action="{{ route('frontend.add-visitors.destroy', $addVisitor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('add_visitor_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.add-visitors.massDestroy') }}",
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
  let table = $('.datatable-AddVisitor:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection