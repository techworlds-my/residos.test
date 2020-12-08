@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.facilitypayment.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.facilitypayments.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.facilitypayment.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $facilitypayment->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.facilitypayment.fields.amount') }}
                                    </th>
                                    <td>
                                        {{ $facilitypayment->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.facilitypayment.fields.reciept') }}
                                    </th>
                                    <td>
                                        @if($facilitypayment->reciept)
                                            <a href="{{ $facilitypayment->reciept->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.facilitypayment.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Facilitypayment::STATUS_SELECT[$facilitypayment->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.facilitypayment.fields.username') }}
                                    </th>
                                    <td>
                                        {{ $facilitypayment->username->username ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.facilitypayment.fields.payment_method') }}
                                    </th>
                                    <td>
                                        {{ $facilitypayment->payment_method->method ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.facilitypayments.index') }}">
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