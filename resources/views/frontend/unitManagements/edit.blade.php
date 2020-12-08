@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.unitManagement.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.unit-managements.update", [$unitManagement->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="unit_id">{{ trans('cruds.unitManagement.fields.unit') }}</label>
                            <select class="form-control select2" name="unit_id" id="unit_id" required>
                                @foreach($units as $id => $unit)
                                    <option value="{{ $id }}" {{ (old('unit_id') ? old('unit_id') : $unitManagement->unit->id ?? '') == $id ? 'selected' : '' }}>{{ $unit }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('unit'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('unit') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.unitManagement.fields.unit_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="owner_id">{{ trans('cruds.unitManagement.fields.owner') }}</label>
                            <select class="form-control select2" name="owner_id" id="owner_id" required>
                                @foreach($owners as $id => $owner)
                                    <option value="{{ $id }}" {{ (old('owner_id') ? old('owner_id') : $unitManagement->owner->id ?? '') == $id ? 'selected' : '' }}>{{ $owner }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('owner'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('owner') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.unitManagement.fields.owner_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.unitManagement.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\UnitManagement::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $unitManagement->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.unitManagement.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="size">{{ trans('cruds.unitManagement.fields.size') }}</label>
                            <input class="form-control" type="number" name="size" id="size" value="{{ old('size', $unitManagement->size) }}" step="1" required>
                            @if($errors->has('size'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('size') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.unitManagement.fields.size_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="spa">{{ trans('cruds.unitManagement.fields.spa') }}</label>
                            <div class="needsclick dropzone" id="spa-dropzone">
                            </div>
                            @if($errors->has('spa'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('spa') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.unitManagement.fields.spa_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.spaDropzone = {
    url: '{{ route('admin.unit-managements.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="spa"]').remove()
      $('form').append('<input type="hidden" name="spa" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="spa"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($unitManagement) && $unitManagement->spa)
      var file = {!! json_encode($unitManagement->spa) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="spa" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection