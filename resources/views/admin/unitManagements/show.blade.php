@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.unitManagement.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.unit-managements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.unitManagement.fields.id') }}
                        </th>
                        <td>
                            {{ $unitManagement->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unitManagement.fields.unit') }}
                        </th>
                        <td>
                            {{ $unitManagement->unit->unit ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unitManagement.fields.owner') }}
                        </th>
                        <td>
                            {{ $unitManagement->owner->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unitManagement.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\UnitManagement::STATUS_SELECT[$unitManagement->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unitManagement.fields.size') }}
                        </th>
                        <td>
                            {{ $unitManagement->size }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unitManagement.fields.spa') }}
                        </th>
                        <td>
                            @if($unitManagement->spa)
                                <a href="{{ $unitManagement->spa->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.unit-managements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection