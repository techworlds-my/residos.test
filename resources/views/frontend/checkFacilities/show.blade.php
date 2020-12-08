@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.checkFacility.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.check-facilities.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.checkFacility.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $checkFacility->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.checkFacility.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $checkFacility->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.checkFacility.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\CheckFacility::STATUS_SELECT[$checkFacility->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.checkFacility.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $checkFacility->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.checkFacility.fields.image') }}
                                    </th>
                                    <td>
                                        @if($checkFacility->image)
                                            <a href="{{ $checkFacility->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $checkFacility->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.checkFacility.fields.date_time') }}
                                    </th>
                                    <td>
                                        {{ $checkFacility->date_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.checkFacility.fields.facility') }}
                                    </th>
                                    <td>
                                        {{ $checkFacility->facility->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.checkFacility.fields.defect') }}
                                    </th>
                                    <td>
                                        {{ $checkFacility->defect->defact_category ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.check-facilities.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection