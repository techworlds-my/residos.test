@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.addDefect.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.add-defects.update", [$addDefect->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="defect">{{ trans('cruds.addDefect.fields.defect') }}</label>
                <input class="form-control {{ $errors->has('defect') ? 'is-invalid' : '' }}" type="text" name="defect" id="defect" value="{{ old('defect', $addDefect->defect) }}" required>
                @if($errors->has('defect'))
                    <div class="invalid-feedback">
                        {{ $errors->first('defect') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addDefect.fields.defect_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="image">{{ trans('cruds.addDefect.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addDefect.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="available_date">{{ trans('cruds.addDefect.fields.available_date') }}</label>
                <input class="form-control date {{ $errors->has('available_date') ? 'is-invalid' : '' }}" type="text" name="available_date" id="available_date" value="{{ old('available_date', $addDefect->available_date) }}" required>
                @if($errors->has('available_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('available_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addDefect.fields.available_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="available_time">{{ trans('cruds.addDefect.fields.available_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('available_time') ? 'is-invalid' : '' }}" type="text" name="available_time" id="available_time" value="{{ old('available_time', $addDefect->available_time) }}" required>
                @if($errors->has('available_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('available_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addDefect.fields.available_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remark">{{ trans('cruds.addDefect.fields.remark') }}</label>
                <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="text" name="remark" id="remark" value="{{ old('remark', $addDefect->remark) }}">
                @if($errors->has('remark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('remark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addDefect.fields.remark_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="username_id">{{ trans('cruds.addDefect.fields.username') }}</label>
                <select class="form-control select2 {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username_id" id="username_id" required>
                    @foreach($usernames as $id => $username)
                        <option value="{{ $id }}" {{ (old('username_id') ? old('username_id') : $addDefect->username->id ?? '') == $id ? 'selected' : '' }}>{{ $username }}</option>
                    @endforeach
                </select>
                @if($errors->has('username'))
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addDefect.fields.username_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.addDefect.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $addDefect->category->id ?? '') == $id ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addDefect.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.addDefect.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $addDefect->status->id ?? '') == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addDefect.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="inchargeperson_id">{{ trans('cruds.addDefect.fields.inchargeperson') }}</label>
                <select class="form-control select2 {{ $errors->has('inchargeperson') ? 'is-invalid' : '' }}" name="inchargeperson_id" id="inchargeperson_id">
                    @foreach($inchargepeople as $id => $inchargeperson)
                        <option value="{{ $id }}" {{ (old('inchargeperson_id') ? old('inchargeperson_id') : $addDefect->inchargeperson->id ?? '') == $id ? 'selected' : '' }}>{{ $inchargeperson }}</option>
                    @endforeach
                </select>
                @if($errors->has('inchargeperson'))
                    <div class="invalid-feedback">
                        {{ $errors->first('inchargeperson') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.addDefect.fields.inchargeperson_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    var uploadedImageMap = {}
Dropzone.options.imageDropzone = {
    url: '{{ route('admin.add-defects.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 2048,
      height: 2048
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="image[]" value="' + response.name + '">')
      uploadedImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImageMap[file.name]
      }
      $('form').find('input[name="image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($addDefect) && $addDefect->image)
      var files = {!! json_encode($addDefect->image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="image[]" value="' + file.file_name + '">')
        }
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