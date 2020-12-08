@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.addDefect.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.add-defects.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.addDefect.fields.id') }}
                        </th>
                        <td>
                            {{ $addDefect->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addDefect.fields.defect') }}
                        </th>
                        <td>
                            {{ $addDefect->defect }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addDefect.fields.image') }}
                        </th>
                        <td>
                            @foreach($addDefect->image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addDefect.fields.available_date') }}
                        </th>
                        <td>
                            {{ $addDefect->available_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addDefect.fields.available_time') }}
                        </th>
                        <td>
                            {{ $addDefect->available_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addDefect.fields.remark') }}
                        </th>
                        <td>
                            {{ $addDefect->remark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addDefect.fields.username') }}
                        </th>
                        <td>
                            {{ $addDefect->username->username ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addDefect.fields.category') }}
                        </th>
                        <td>
                            {{ $addDefect->category->defact_category ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addDefect.fields.status') }}
                        </th>
                        <td>
                            {{ $addDefect->status->status ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addDefect.fields.inchargeperson') }}
                        </th>
                        <td>
                            {{ $addDefect->inchargeperson->username ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.add-defects.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection