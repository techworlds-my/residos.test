@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.qr.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.qrs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.qr.fields.id') }}
                        </th>
                        <td>
                            {{ $qr->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qr.fields.code') }}
                        </th>
                        <td>
                            {{ $qr->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qr.fields.status') }}
                        </th>
                        <td>
                            {{ $qr->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qr.fields.username') }}
                        </th>
                        <td>
                            {{ $qr->username->username ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.qrs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection