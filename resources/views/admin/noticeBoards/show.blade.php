@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.noticeBoard.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.notice-boards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.noticeBoard.fields.id') }}
                        </th>
                        <td>
                            {{ $noticeBoard->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noticeBoard.fields.title') }}
                        </th>
                        <td>
                            {{ $noticeBoard->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noticeBoard.fields.content') }}
                        </th>
                        <td>
                            {{ $noticeBoard->content }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noticeBoard.fields.post_at') }}
                        </th>
                        <td>
                            {{ $noticeBoard->post_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noticeBoard.fields.post_to') }}
                        </th>
                        <td>
                            {{ $noticeBoard->post_to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noticeBoard.fields.pinned') }}
                        </th>
                        <td>
                            {{ $noticeBoard->pinned }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noticeBoard.fields.status') }}
                        </th>
                        <td>
                            {{ $noticeBoard->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noticeBoard.fields.post_by') }}
                        </th>
                        <td>
                            {{ $noticeBoard->post_by }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.noticeBoard.fields.image') }}
                        </th>
                        <td>
                            @if($noticeBoard->image)
                                <a href="{{ $noticeBoard->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $noticeBoard->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.notice-boards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection