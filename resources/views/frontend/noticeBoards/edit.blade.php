@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.noticeBoard.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.notice-boards.update", [$noticeBoard->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.noticeBoard.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $noticeBoard->title) }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.noticeBoard.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="content">{{ trans('cruds.noticeBoard.fields.content') }}</label>
                            <textarea class="form-control" name="content" id="content" required>{{ old('content', $noticeBoard->content) }}</textarea>
                            @if($errors->has('content'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('content') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.noticeBoard.fields.content_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="post_at">{{ trans('cruds.noticeBoard.fields.post_at') }}</label>
                            <input class="form-control datetime" type="text" name="post_at" id="post_at" value="{{ old('post_at', $noticeBoard->post_at) }}" required>
                            @if($errors->has('post_at'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('post_at') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.noticeBoard.fields.post_at_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="post_to">{{ trans('cruds.noticeBoard.fields.post_to') }}</label>
                            <input class="form-control" type="text" name="post_to" id="post_to" value="{{ old('post_to', $noticeBoard->post_to) }}" required>
                            @if($errors->has('post_to'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('post_to') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.noticeBoard.fields.post_to_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="pinned">{{ trans('cruds.noticeBoard.fields.pinned') }}</label>
                            <input class="form-control" type="number" name="pinned" id="pinned" value="{{ old('pinned', $noticeBoard->pinned) }}" step="1">
                            @if($errors->has('pinned'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pinned') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.noticeBoard.fields.pinned_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.noticeBoard.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', $noticeBoard->status) }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.noticeBoard.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="post_by">{{ trans('cruds.noticeBoard.fields.post_by') }}</label>
                            <input class="form-control" type="text" name="post_by" id="post_by" value="{{ old('post_by', $noticeBoard->post_by) }}">
                            @if($errors->has('post_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('post_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.noticeBoard.fields.post_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="image">{{ trans('cruds.noticeBoard.fields.image') }}</label>
                            <div class="needsclick dropzone" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.noticeBoard.fields.image_helper') }}</span>
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
    url: '{{ route('admin.notice-boards.storeMedia') }}',
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
@if(isset($noticeBoard) && $noticeBoard->image)
      var file = {!! json_encode($noticeBoard->image) !!}
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