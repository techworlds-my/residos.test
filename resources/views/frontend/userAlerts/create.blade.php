@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.userAlert.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.user-alerts.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="alert_text">{{ trans('cruds.userAlert.fields.alert_text') }}</label>
                            <input class="form-control" type="text" name="alert_text" id="alert_text" value="{{ old('alert_text', '') }}" required>
                            @if($errors->has('alert_text'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('alert_text') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.userAlert.fields.alert_text_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="alert_link">{{ trans('cruds.userAlert.fields.alert_link') }}</label>
                            <input class="form-control" type="text" name="alert_link" id="alert_link" value="{{ old('alert_link', '') }}">
                            @if($errors->has('alert_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('alert_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.userAlert.fields.alert_link_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.userAlert.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $user)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.userAlert.fields.user_helper') }}</span>
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