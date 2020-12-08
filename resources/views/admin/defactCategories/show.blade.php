@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.defactCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.defact-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.defactCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $defactCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.defactCategory.fields.defact_category') }}
                        </th>
                        <td>
                            {{ $defactCategory->defact_category }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.defactCategory.fields.in_enable') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $defactCategory->in_enable ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.defact-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection