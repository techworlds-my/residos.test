@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.carparkLog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.carpark-logs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="time_in">{{ trans('cruds.carparkLog.fields.time_in') }}</label>
                <input class="form-control {{ $errors->has('time_in') ? 'is-invalid' : '' }}" type="text" name="time_in" id="time_in" value="{{ old('time_in', '') }}">
                @if($errors->has('time_in'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time_in') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.carparkLog.fields.time_in_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="time_out">{{ trans('cruds.carparkLog.fields.time_out') }}</label>
                <input class="form-control {{ $errors->has('time_out') ? 'is-invalid' : '' }}" type="text" name="time_out" id="time_out" value="{{ old('time_out', '') }}">
                @if($errors->has('time_out'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time_out') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.carparkLog.fields.time_out_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.carparkLog.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="1">
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.carparkLog.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="carplate_id">{{ trans('cruds.carparkLog.fields.carplate') }}</label>
                <select class="form-control select2 {{ $errors->has('carplate') ? 'is-invalid' : '' }}" name="carplate_id" id="carplate_id" required>
                    @foreach($carplates as $id => $carplate)
                        <option value="{{ $id }}" {{ old('carplate_id') == $id ? 'selected' : '' }}>{{ $carplate }}</option>
                    @endforeach
                </select>
                @if($errors->has('carplate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('carplate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.carparkLog.fields.carplate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="location_id">{{ trans('cruds.carparkLog.fields.location') }}</label>
                <select class="form-control select2 {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location_id" id="location_id">
                    @foreach($locations as $id => $location)
                        <option value="{{ $id }}" {{ old('location_id') == $id ? 'selected' : '' }}>{{ $location }}</option>
                    @endforeach
                </select>
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.carparkLog.fields.location_helper') }}</span>
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