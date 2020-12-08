@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.eventPayment.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.event-payments.update", [$eventPayment->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="payment">{{ trans('cruds.eventPayment.fields.payment') }}</label>
                            <input class="form-control" type="number" name="payment" id="payment" value="{{ old('payment', $eventPayment->payment) }}" step="1" required>
                            @if($errors->has('payment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventPayment.fields.payment_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="payment_method">{{ trans('cruds.eventPayment.fields.payment_method') }}</label>
                            <input class="form-control" type="text" name="payment_method" id="payment_method" value="{{ old('payment_method', $eventPayment->payment_method) }}">
                            @if($errors->has('payment_method'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment_method') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventPayment.fields.payment_method_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="username_id">{{ trans('cruds.eventPayment.fields.username') }}</label>
                            <select class="form-control select2" name="username_id" id="username_id" required>
                                @foreach($usernames as $id => $username)
                                    <option value="{{ $id }}" {{ (old('username_id') ? old('username_id') : $eventPayment->username->id ?? '') == $id ? 'selected' : '' }}>{{ $username }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('username'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventPayment.fields.username_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="event_id">{{ trans('cruds.eventPayment.fields.event') }}</label>
                            <select class="form-control select2" name="event_id" id="event_id" required>
                                @foreach($events as $id => $event)
                                    <option value="{{ $id }}" {{ (old('event_id') ? old('event_id') : $eventPayment->event->id ?? '') == $id ? 'selected' : '' }}>{{ $event }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('event'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventPayment.fields.event_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection