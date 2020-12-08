@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.eventControl.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-controls.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.eventControl.fields.id') }}
                        </th>
                        <td>
                            {{ $eventControl->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventControl.fields.title') }}
                        </th>
                        <td>
                            {{ $eventControl->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventControl.fields.date') }}
                        </th>
                        <td>
                            {{ $eventControl->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventControl.fields.time') }}
                        </th>
                        <td>
                            {{ $eventControl->time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventControl.fields.payment') }}
                        </th>
                        <td>
                            {{ $eventControl->payment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventControl.fields.participants') }}
                        </th>
                        <td>
                            {{ $eventControl->participants }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventControl.fields.status') }}
                        </th>
                        <td>
                            {{ $eventControl->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventControl.fields.image') }}
                        </th>
                        <td>
                            @if($eventControl->image)
                                <a href="{{ $eventControl->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $eventControl->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventControl.fields.category') }}
                        </th>
                        <td>
                            {{ $eventControl->category->cateogey ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventControl.fields.audience_group') }}
                        </th>
                        <td>
                            {{ $eventControl->audience_group->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-controls.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection