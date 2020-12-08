@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('check_facility_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.check-facilities.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-CheckFacility">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($checkFacilities as $key => $checkFacility)
                                    <tr data-entry-id="{{ $checkFacility->id }}">
                                        <td>
                                            {{ $checkFacility->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $checkFacility->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\CheckFacility::STATUS_SELECT[$checkFacility->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $checkFacility->description ?? '' }}
                                        </td>
                                        <td>
                                            @if($checkFacility->image)
                                                <a href="{{ $checkFacility->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $checkFacility->image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $checkFacility->date_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $checkFacility->facility->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $checkFacility->defect->defact_category ?? '' }}
                                        </td>
                                        <td>
                                            @can('check_facility_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.check-facilities.show', $checkFacility->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('check_facility_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.check-facilities.edit', $checkFacility->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('check_facility_delete')
                                                <form action="{{ route('frontend.check-facilities.destroy', $checkFacility->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('check_facility_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.check-facilities.massDestroy') }}",
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
  let table = $('.datatable-CheckFacility:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection