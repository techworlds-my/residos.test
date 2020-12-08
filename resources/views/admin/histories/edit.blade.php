@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.history.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.histories.update", [$history->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="qr">{{ trans('cruds.history.fields.qr') }}</label>
                <input class="form-control {{ $errors->has('qr') ? 'is-invalid' : '' }}" type="text" name="qr" id="qr" value="{{ old('qr', $history->qr) }}" required>
                @if($errors->has('qr'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qr') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.history.fields.qr_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="type">{{ trans('cruds.history.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', $history->type) }}" required>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.history.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="username_id">{{ trans('cruds.history.fields.username') }}</label>
                <select class="form-control select2 {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username_id" id="username_id" required>
                    @foreach($usernames as $id => $username)
                        <option value="{{ $id }}" {{ (old('username_id') ? old('username_id') : $history->username->id ?? '') == $id ? 'selected' : '' }}>{{ $username }}</option>
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
                <select class="form-control select2 {{ $errors->has('entrance') ? 'is-invalid' : '' }}" name="entrance_id" id="entrance_id" required>
                    @foreach($entrances as $id => $entrance)
                        <option value="{{ $id }}" {{ (old('entrance_id') ? old('entrance_id') : $history->entrance->id ?? '') == $id ? 'selected' : '' }}>{{ $entrance }}</option>
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



@endsection