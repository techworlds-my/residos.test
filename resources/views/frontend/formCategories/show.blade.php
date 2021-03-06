@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.formCategory.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.form-categories.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.formCategory.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $formCategory->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.formCategory.fields.category') }}
                                    </th>
                                    <td>
                                        {{ $formCategory->category }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.formCategory.fields.in_enable') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $formCategory->in_enable ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.form-categories.index') }}">
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