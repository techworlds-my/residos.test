@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.carparkPayment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.carpark-payments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.carparkPayment.fields.id') }}
                        </th>
                        <td>
                            {{ $carparkPayment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carparkPayment.fields.carplate') }}
                        </th>
                        <td>
                            {{ $carparkPayment->carplate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carparkPayment.fields.payment') }}
                        </th>
                        <td>
                            {{ $carparkPayment->payment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carparkPayment.fields.payment_method') }}
                        </th>
                        <td>
                            {{ $carparkPayment->payment_method }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carparkPayment.fields.remark') }}
                        </th>
                        <td>
                            {{ $carparkPayment->remark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carparkPayment.fields.status') }}
                        </th>
                        <td>
                            {{ $carparkPayment->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carparkPayment.fields.location') }}
                        </th>
                        <td>
                            {{ $carparkPayment->location->location ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.carpark-payments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection