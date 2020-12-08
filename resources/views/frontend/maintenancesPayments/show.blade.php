@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.maintenancesPayment.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.maintenances-payments.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenancesPayment.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $maintenancesPayment->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenancesPayment.fields.amount') }}
                                    </th>
                                    <td>
                                        {{ $maintenancesPayment->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenancesPayment.fields.month') }}
                                    </th>
                                    <td>
                                        {{ $maintenancesPayment->month }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenancesPayment.fields.receipt') }}
                                    </th>
                                    <td>
                                        @if($maintenancesPayment->receipt)
                                            <a href="{{ $maintenancesPayment->receipt->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenancesPayment.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\MaintenancesPayment::STATUS_SELECT[$maintenancesPayment->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenancesPayment.fields.username') }}
                                    </th>
                                    <td>
                                        {{ $maintenancesPayment->username->username ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenancesPayment.fields.payment_method') }}
                                    </th>
                                    <td>
                                        {{ $maintenancesPayment->payment_method->method ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.maintenances-payments.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection