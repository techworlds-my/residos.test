@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.eventPayment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-payments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.eventPayment.fields.id') }}
                        </th>
                        <td>
                            {{ $eventPayment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventPayment.fields.payment') }}
                        </th>
                        <td>
                            {{ $eventPayment->payment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventPayment.fields.payment_method') }}
                        </th>
                        <td>
                            {{ $eventPayment->payment_method }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventPayment.fields.username') }}
                        </th>
                        <td>
                            {{ $eventPayment->username->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventPayment.fields.event') }}
                        </th>
                        <td>
                            {{ $eventPayment->event->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-payments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection