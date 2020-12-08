@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.addTanent.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.add-tanents.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="unit_id">{{ trans('cruds.addTanent.fields.unit') }}</label>
                <select class="form-control select2 {{ $errors->has('unit') ? 'is-invalid' : '' }}" name="unit_id" id="unit_id" required>
                    @foreach($units as $id => $unit)
                        <option value="{{ $id }}" {{ old('unit_id') == $id ? 'selected' : '' }}>{{ $unit }}</option>
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
                <select class="form-control select2 {{ $errors->has('tanent') ? 'is-invalid' : '' }}" name="tanent_id" id="tanent_id" required>
                    @foreach($tanents as $id => $tanent)
                        <option value="{{ $id }}" {{ old('tanent_id') == $id ? 'selected' : '' }}>{{ $tanent }}</option>
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



@endsection