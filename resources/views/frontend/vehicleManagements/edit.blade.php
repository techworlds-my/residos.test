@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.vehicleManagement.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.vehicle-managements.update", [$vehicleManagement->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="username_id">{{ trans('cruds.vehicleManagement.fields.username') }}</label>
                            <select class="form-control select2" name="username_id" id="username_id" required>
                                @foreach($usernames as $id => $username)
                                    <option value="{{ $id }}" {{ (old('username_id') ? old('username_id') : $vehicleManagement->username->id ?? '') == $id ? 'selected' : '' }}>{{ $username }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('username'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleManagement.fields.username_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="car_plate">{{ trans('cruds.vehicleManagement.fields.car_plate') }}</label>
                            <input class="form-control" type="text" name="car_plate" id="car_plate" value="{{ old('car_plate', $vehicleManagement->car_plate) }}" required>
                            @if($errors->has('car_plate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('car_plate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleManagement.fields.car_plate_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_verify" value="0">
                                <input type="checkbox" name="is_verify" id="is_verify" value="1" {{ $vehicleManagement->is_verify || old('is_verify', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_verify">{{ trans('cruds.vehicleManagement.fields.is_verify') }}</label>
                            </div>
                            @if($errors->has('is_verify'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_verify') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleManagement.fields.is_verify_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="brand_id">{{ trans('cruds.vehicleManagement.fields.brand') }}</label>
                            <select class="form-control select2" name="brand_id" id="brand_id">
                                @foreach($brands as $id => $brand)
                                    <option value="{{ $id }}" {{ (old('brand_id') ? old('brand_id') : $vehicleManagement->brand->id ?? '') == $id ? 'selected' : '' }}>{{ $brand }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('brand'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('brand') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleManagement.fields.brand_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="modal">{{ trans('cruds.vehicleManagement.fields.modal') }}</label>
                            <input class="form-control" type="text" name="modal" id="modal" value="{{ old('modal', $vehicleManagement->modal) }}">
                            @if($errors->has('modal'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('modal') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleManagement.fields.modal_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="color">{{ trans('cruds.vehicleManagement.fields.color') }}</label>
                            <input class="form-control" type="text" name="color" id="color" value="{{ old('color', $vehicleManagement->color) }}">
                            @if($errors->has('color'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('color') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleManagement.fields.color_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="checkbox" name="is_season_park" id="is_season_park" value="1" {{ $vehicleManagement->is_season_park || old('is_season_park', 0) === 1 ? 'checked' : '' }} required>
                                <label class="required" for="is_season_park">{{ trans('cruds.vehicleManagement.fields.is_season_park') }}</label>
                            </div>
                            @if($errors->has('is_season_park'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_season_park') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleManagement.fields.is_season_park_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="dirver_count">{{ trans('cruds.vehicleManagement.fields.dirver_count') }}</label>
                            <input class="form-control" type="number" name="dirver_count" id="dirver_count" value="{{ old('dirver_count', $vehicleManagement->dirver_count) }}" step="1">
                            @if($errors->has('dirver_count'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dirver_count') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleManagement.fields.dirver_count_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="checkbox" name="is_resident" id="is_resident" value="1" {{ $vehicleManagement->is_resident || old('is_resident', 0) === 1 ? 'checked' : '' }} required>
                                <label class="required" for="is_resident">{{ trans('cruds.vehicleManagement.fields.is_resident') }}</label>
                            </div>
                            @if($errors->has('is_resident'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_resident') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleManagement.fields.is_resident_helper') }}</span>
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