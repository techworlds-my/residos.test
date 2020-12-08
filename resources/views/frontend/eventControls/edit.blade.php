@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.eventControl.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.event-controls.update", [$eventControl->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.eventControl.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $eventControl->title) }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventControl.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.eventControl.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date', $eventControl->date) }}" required>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventControl.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="time">{{ trans('cruds.eventControl.fields.time') }}</label>
                            <input class="form-control timepicker" type="text" name="time" id="time" value="{{ old('time', $eventControl->time) }}" required>
                            @if($errors->has('time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventControl.fields.time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="payment">{{ trans('cruds.eventControl.fields.payment') }}</label>
                            <input class="form-control" type="text" name="payment" id="payment" value="{{ old('payment', $eventControl->payment) }}">
                            @if($errors->has('payment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventControl.fields.payment_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="participants">{{ trans('cruds.eventControl.fields.participants') }}</label>
                            <input class="form-control" type="number" name="participants" id="participants" value="{{ old('participants', $eventControl->participants) }}" step="1">
                            @if($errors->has('participants'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('participants') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventControl.fields.participants_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="status">{{ trans('cruds.eventControl.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', $eventControl->status) }}" required>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventControl.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="image">{{ trans('cruds.eventControl.fields.image') }}</label>
                            <div class="needsclick dropzone" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventControl.fields.image_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="category_id">{{ trans('cruds.eventControl.fields.category') }}</label>
                            <select class="form-control select2" name="category_id" id="category_id" required>
                                @foreach($categories as $id => $category)
                                    <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $eventControl->category->id ?? '') == $id ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventControl.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="audience_group_id">{{ trans('cruds.eventControl.fields.audience_group') }}</label>
                            <select class="form-control select2" name="audience_group_id" id="audience_group_id">
                                @foreach($audience_groups as $id => $audience_group)
                                    <option value="{{ $id }}" {{ (old('audience_group_id') ? old('audience_group_id') : $eventControl->audience_group->id ?? '') == $id ? 'selected' : '' }}>{{ $audience_group }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('audience_group'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('audience_group') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventControl.fields.audience_group_helper') }}</span>
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
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.event-controls.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($eventControl) && $eventControl->image)
      var file = {!! json_encode($eventControl->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
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