@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.carparkLog.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.carpark-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.carparkLog.fields.id') }}
                        </th>
                        <td>
                            {{ $carparkLog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carparkLog.fields.time_in') }}
                        </th>
                        <td>
                            {{ $carparkLog->time_in }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carparkLog.fields.time_out') }}
                        </th>
                        <td>
                            {{ $carparkLog->time_out }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carparkLog.fields.price') }}
                        </th>
                        <td>
                            {{ $carparkLog->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carparkLog.fields.carplate') }}
                        </th>
                        <td>
                            {{ $carparkLog->carplate->car_plate ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carparkLog.fields.location') }}
                        </th>
                        <td>
                            {{ $carparkLog->location->location ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.carpark-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection