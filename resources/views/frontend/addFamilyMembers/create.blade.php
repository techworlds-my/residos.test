@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.addFamilyMember.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.add-family-members.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="unit_id">{{ trans('cruds.addFamilyMember.fields.unit') }}</label>
                            <select class="form-control select2" name="unit_id" id="unit_id" required>
                                @foreach($units as $id => $unit)
                                    <option value="{{ $id }}" {{ old('unit_id') == $id ? 'selected' : '' }}>{{ $unit }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('unit'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('unit') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.addFamilyMember.fields.unit_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="family_member_id">{{ trans('cruds.addFamilyMember.fields.family_member') }}</label>
                            <select class="form-control select2" name="family_member_id" id="family_member_id" required>
                                @foreach($family_members as $id => $family_member)
                                    <option value="{{ $id }}" {{ old('family_member_id') == $id ? 'selected' : '' }}>{{ $family_member }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('family_member'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('family_member') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.addFamilyMember.fields.family_member_helper') }}</span>
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