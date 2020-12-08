@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('facility_book_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.facility-books.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.facilityBook.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.facilityBook.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-FacilityBook">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.facilityBook.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.facilityBook.fields.date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.facilityBook.fields.time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.facilityBook.fields.facility') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.facilityBook.fields.user') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($facilityBooks as $key => $facilityBook)
                                    <tr data-entry-id="{{ $facilityBook->id }}">
                                        <td>
                                            {{ $facilityBook->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $facilityBook->date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $facilityBook->time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $facilityBook->facility->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $facilityBook->user->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('facility_book_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.facility-books.show', $facilityBook->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('facility_book_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.facility-books.edit', $facilityBook->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('facility_book_delete')
                                                <form action="{{ route('frontend.facility-books.destroy', $facilityBook->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('facility_book_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.facility-books.massDestroy') }}",
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
  let table = $('.datatable-FacilityBook:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection