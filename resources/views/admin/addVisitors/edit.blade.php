@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.addVisitor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.add-visitors.update", [$addVisitor->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.addVisitor.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AddVisitor::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $addVisitor->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addVisitor.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="username_id">{{ trans('cruds.addVisitor.fields.username') }}</label>
                <select class="form-control select2 {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username_id" id="username_id" required>
                    @foreach($usernames as $id => $username)
                        <option value="{{ $id }}" {{ (old('username_id') ? old('username_id') : $addVisitor->username->id ?? '') == $id ? 'selected' : '' }}>{{ $username }}</option>
                    @endforeach
                </select>
                @if($errors->has('username'))
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addVisitor.fields.username_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="add_by_id">{{ trans('cruds.addVisitor.fields.add_by') }}</label>
                <select class="form-control select2 {{ $errors->has('add_by') ? 'is-invalid' : '' }}" name="add_by_id" id="add_by_id">
                    @foreach($add_bies as $id => $add_by)
                        <option value="{{ $id }}" {{ (old('add_by_id') ? old('add_by_id') : $addVisitor->add_by->id ?? '') == $id ? 'selected' : '' }}>{{ $add_by }}</option>
                    @endforeach
                </select>
                @if($errors->has('add_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('add_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addVisitor.fields.add_by_helper') }}</span>
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