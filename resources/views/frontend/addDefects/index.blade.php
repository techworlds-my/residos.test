@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('add_defect_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.add-defects.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-AddDefect">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($addDefects as $key => $addDefect)
                                    <tr data-entry-id="{{ $addDefect->id }}">
                                        <td>
                                            {{ $addDefect->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addDefect->defect ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($addDefect->image as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $media->getUrl('thumb') }}">
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $addDefect->available_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addDefect->available_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addDefect->remark ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addDefect->username->username ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addDefect->category->defact_category ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addDefect->status->status ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addDefect->inchargeperson->username ?? '' }}
                                        </td>
                                        <td>
                                            @can('add_defect_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.add-defects.show', $addDefect->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('add_defect_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.add-defects.edit', $addDefect->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('add_defect_delete')
                                                <form action="{{ route('frontend.add-defects.destroy', $addDefect->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('add_defect_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.add-defects.massDestroy') }}",
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
  let table = $('.datatable-AddDefect:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection