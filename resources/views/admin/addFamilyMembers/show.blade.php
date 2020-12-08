@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.addFamilyMember.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.add-family-members.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.addFamilyMember.fields.id') }}
                        </th>
                        <td>
                            {{ $addFamilyMember->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addFamilyMember.fields.unit') }}
                        </th>
                        <td>
                            {{ $addFamilyMember->unit->unit ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addFamilyMember.fields.family_member') }}
                        </th>
                        <td>
                            {{ $addFamilyMember->family_member->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.add-family-members.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection