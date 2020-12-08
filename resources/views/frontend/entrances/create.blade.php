@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.entrance.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.entrances.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.entrance.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.entrance.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_active">{{ trans('cruds.entrance.fields.last_active') }}</label>
                            <input class="form-control" type="text" name="last_active" id="last_active" value="{{ old('last_active', '') }}">
                            @if($errors->has('last_active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.entrance.fields.last_active_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="in_enable" value="0">
                                <input type="checkbox" name="in_enable" id="in_enable" value="1" {{ old('in_enable', 0) == 1 ? 'checked' : '' }}>
                                <label for="in_enable">{{ trans('cruds.entrance.fields.in_enable') }}</label>
                            </div>
                            @if($errors->has('in_enable'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('in_enable') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.entrance.fields.in_enable_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="location_id">{{ trans('cruds.entrance.fields.location') }}</label>
                            <select class="form-control select2" name="location_id" id="location_id" required>
                                @foreach($locations as $id => $location)
                                    <option value="{{ $id }}" {{ old('location_id') == $id ? 'selected' : '' }}>{{ $location }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.entrance.fields.location_helper') }}</span>
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