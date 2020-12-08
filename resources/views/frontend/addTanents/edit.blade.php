@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.addTanent.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.add-tanents.update", [$addTanent->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="unit_id">{{ trans('cruds.addTanent.fields.unit') }}</label>
                            <select class="form-control select2" name="unit_id" id="unit_id" required>
                                @foreach($units as $id => $unit)
                                    <option value="{{ $id }}" {{ (old('unit_id') ? old('unit_id') : $addTanent->unit->id ?? '') == $id ? 'selected' : '' }}>{{ $unit }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('unit'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('unit') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.addTanent.fields.unit_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="tanent_id">{{ trans('cruds.addTanent.fields.tanent') }}</label>
                            <select class="form-control select2" name="tanent_id" id="tanent_id" required>
                                @foreach($tanents as $id => $tanent)
                                    <option value="{{ $id }}" {{ (old('tanent_id') ? old('tanent_id') : $addTanent->tanent->id ?? '') == $id ? 'selected' : '' }}>{{ $tanent }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tanent'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanent') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.addTanent.fields.tanent_helper') }}</span>
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