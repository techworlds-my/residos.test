@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.facilityCategory.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.facility-categories.update", [$facilityCategory->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="category">{{ trans('cruds.facilityCategory.fields.category') }}</label>
                            <input class="form-control" type="text" name="category" id="category" value="{{ old('category', $facilityCategory->category) }}" required>
                            @if($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.facilityCategory.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="in_enable" value="0">
                                <input type="checkbox" name="in_enable" id="in_enable" value="1" {{ $facilityCategory->in_enable || old('in_enable', 0) === 1 ? 'checked' : '' }}>
                                <label for="in_enable">{{ trans('cruds.facilityCategory.fields.in_enable') }}</label>
                            </div>
                            @if($errors->has('in_enable'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('in_enable') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.facilityCategory.fields.in_enable_helper') }}</span>
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