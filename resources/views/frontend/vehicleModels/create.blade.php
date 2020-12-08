@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.vehicleModel.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.vehicle-models.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="brand_id">{{ trans('cruds.vehicleModel.fields.brand') }}</label>
                            <select class="form-control select2" name="brand_id" id="brand_id" required>
                                @foreach($brands as $id => $brand)
                                    <option value="{{ $id }}" {{ old('brand_id') == $id ? 'selected' : '' }}>{{ $brand }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('brand'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('brand') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleModel.fields.brand_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="model">{{ trans('cruds.vehicleModel.fields.model') }}</label>
                            <input class="form-control" type="text" name="model" id="model" value="{{ old('model', '') }}" required>
                            @if($errors->has('model'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('model') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleModel.fields.model_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_enable" value="0">
                                <input type="checkbox" name="is_enable" id="is_enable" value="1" {{ old('is_enable', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_enable">{{ trans('cruds.vehicleModel.fields.is_enable') }}</label>
                            </div>
                            @if($errors->has('is_enable'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_enable') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.vehicleModel.fields.is_enable_helper') }}</span>
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