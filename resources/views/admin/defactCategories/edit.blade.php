@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.defactCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.defact-categories.update", [$defactCategory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="defact_category">{{ trans('cruds.defactCategory.fields.defact_category') }}</label>
                <input class="form-control {{ $errors->has('defact_category') ? 'is-invalid' : '' }}" type="text" name="defact_category" id="defact_category" value="{{ old('defact_category', $defactCategory->defact_category) }}" required>
                @if($errors->has('defact_category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('defact_category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.defactCategory.fields.defact_category_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('in_enable') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="in_enable" value="0">
                    <input class="form-check-input" type="checkbox" name="in_enable" id="in_enable" value="1" {{ $defactCategory->in_enable || old('in_enable', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="in_enable">{{ trans('cruds.defactCategory.fields.in_enable') }}</label>
                </div>
                @if($errors->has('in_enable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('in_enable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.defactCategory.fields.in_enable_helper') }}</span>
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