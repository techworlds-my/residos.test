@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.addFamilyMember.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.add-family-members.update", [$addFamilyMember->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="unit_id">{{ trans('cruds.addFamilyMember.fields.unit') }}</label>
                <select class="form-control select2 {{ $errors->has('unit') ? 'is-invalid' : '' }}" name="unit_id" id="unit_id" required>
                    @foreach($units as $id => $unit)
                        <option value="{{ $id }}" {{ (old('unit_id') ? old('unit_id') : $addFamilyMember->unit->id ?? '') == $id ? 'selected' : '' }}>{{ $unit }}</option>
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
                <select class="form-control select2 {{ $errors->has('family_member') ? 'is-invalid' : '' }}" name="family_member_id" id="family_member_id" required>
                    @foreach($family_members as $id => $family_member)
                        <option value="{{ $id }}" {{ (old('family_member_id') ? old('family_member_id') : $addFamilyMember->family_member->id ?? '') == $id ? 'selected' : '' }}>{{ $family_member }}</option>
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



@endsection