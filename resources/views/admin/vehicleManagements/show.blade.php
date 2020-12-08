@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.vehicleManagement.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vehicle-managements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleManagement.fields.id') }}
                        </th>
                        <td>
                            {{ $vehicleManagement->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleManagement.fields.username') }}
                        </th>
                        <td>
                            {{ $vehicleManagement->username->username ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleManagement.fields.car_plate') }}
                        </th>
                        <td>
                            {{ $vehicleManagement->car_plate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleManagement.fields.is_verify') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $vehicleManagement->is_verify ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleManagement.fields.brand') }}
                        </th>
                        <td>
                            {{ $vehicleManagement->brand->brand ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleManagement.fields.modal') }}
                        </th>
                        <td>
                            {{ $vehicleManagement->modal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleManagement.fields.color') }}
                        </th>
                        <td>
                            {{ $vehicleManagement->color }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleManagement.fields.is_season_park') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $vehicleManagement->is_season_park ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleManagement.fields.dirver_count') }}
                        </th>
                        <td>
                            {{ $vehicleManagement->dirver_count }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleManagement.fields.is_resident') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $vehicleManagement->is_resident ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vehicle-managements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection