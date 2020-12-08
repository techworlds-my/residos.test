@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.facilityBook.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.facility-books.update", [$facilityBook->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.facilityBook.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $facilityBook->date) }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.facilityBook.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="time">{{ trans('cruds.facilityBook.fields.time') }}</label>
                <input class="form-control timepicker {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="time" value="{{ old('time', $facilityBook->time) }}" required>
                @if($errors->has('time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.facilityBook.fields.time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="facility_id">{{ trans('cruds.facilityBook.fields.facility') }}</label>
                <select class="form-control select2 {{ $errors->has('facility') ? 'is-invalid' : '' }}" name="facility_id" id="facility_id" required>
                    @foreach($facilities as $id => $facility)
                        <option value="{{ $id }}" {{ (old('facility_id') ? old('facility_id') : $facilityBook->facility->id ?? '') == $id ? 'selected' : '' }}>{{ $facility }}</option>
                    @endforeach
                </select>
                @if($errors->has('facility'))
                    <div class="invalid-feedback">
                        {{ $errors->first('facility') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.facilityBook.fields.facility_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.facilityBook.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $facilityBook->user->id ?? '') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.facilityBook.fields.user_helper') }}</span>
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