@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.addFeedback.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.add-feedbacks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.addFeedback.fields.id') }}
                        </th>
                        <td>
                            {{ $addFeedback->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addFeedback.fields.title') }}
                        </th>
                        <td>
                            {{ $addFeedback->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addFeedback.fields.content') }}
                        </th>
                        <td>
                            {!! $addFeedback->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.addFeedback.fields.username') }}
                        </th>
                        <td>
                            {{ $addFeedback->username->username ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.add-feedbacks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection