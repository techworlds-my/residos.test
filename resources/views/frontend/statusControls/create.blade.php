@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.statusControl.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.status-controls.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="status">{{ trans('cruds.statusControl.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', '') }}" required>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.statusControl.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="desctiption">{{ trans('cruds.statusControl.fields.desctiption') }}</label>
                            <input class="form-control" type="text" name="desctiption" id="desctiption" value="{{ old('desctiption', '') }}" required>
                            @if($errors->has('desctiption'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('desctiption') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.statusControl.fields.desctiption_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="checkbox" name="in_enable" id="in_enable" value="1" required {{ old('in_enable', 0) == 1 ? 'checked' : '' }}>
                                <label class="required" for="in_enable">{{ trans('cruds.statusControl.fields.in_enable') }}</label>
                            </div>
                            @if($errors->has('in_enable'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('in_enable') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.statusControl.fields.in_enable_helper') }}</span>
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