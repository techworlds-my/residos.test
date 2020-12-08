@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.addBlock.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.add-blocks.update", [$addBlock->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="block">{{ trans('cruds.addBlock.fields.block') }}</label>
                            <input class="form-control" type="text" name="block" id="block" value="{{ old('block', $addBlock->block) }}" required>
                            @if($errors->has('block'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('block') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.addBlock.fields.block_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection