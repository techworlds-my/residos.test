@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.history.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.histories.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="qr">{{ trans('cruds.history.fields.qr') }}</label>
                            <input class="form-control" type="text" name="qr" id="qr" value="{{ old('qr', '') }}" required>
                            @if($errors->has('qr'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qr') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.history.fields.qr_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="type">{{ trans('cruds.history.fields.type') }}</label>
                            <input class="form-control" type="text" name="type" id="type" value="{{ old('type', '') }}" required>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.history.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="username_id">{{ trans('cruds.history.fields.username') }}</label>
                            <select class="form-control select2" name="username_id" id="username_id" required>
                                @foreach($usernames as $id => $username)
                                    <option value="{{ $id }}" {{ old('username_id') == $id ? 'selected' : '' }}>{{ $username }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('username'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.history.fields.username_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="entrance_id">{{ trans('cruds.history.fields.entrance') }}</label>
                            <select class="form-control select2" name="entrance_id" id="entrance_id" required>
                                @foreach($entrances as $id => $entrance)
                                    <option value="{{ $id }}" {{ old('entrance_id') == $id ? 'selected' : '' }}>{{ $entrance }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('entrance'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('entrance') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.history.fields.entrance_helper') }}</span>
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