@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="username">{{ trans('cruds.user.fields.username') }}</label>
                <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required>
                @if($errors->has('username'))
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.username_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_credit">{{ trans('cruds.user.fields.total_credit') }}</label>
                <input class="form-control {{ $errors->has('total_credit') ? 'is-invalid' : '' }}" type="number" name="total_credit" id="total_credit" value="{{ old('total_credit', $user->total_credit) }}" step="0.01">
                @if($errors->has('total_credit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_credit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.total_credit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="current_credit">{{ trans('cruds.user.fields.current_credit') }}</label>
                <input class="form-control {{ $errors->has('current_credit') ? 'is-invalid' : '' }}" type="number" name="current_credit" id="current_credit" value="{{ old('current_credit', $user->current_credit) }}" step="0.01">
                @if($errors->has('current_credit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('current_credit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.current_credit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_point">{{ trans('cruds.user.fields.total_point') }}</label>
                <input class="form-control {{ $errors->has('total_point') ? 'is-invalid' : '' }}" type="number" name="total_point" id="total_point" value="{{ old('total_point', $user->total_point) }}" step="0.01">
                @if($errors->has('total_point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.total_point_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="current_point">{{ trans('cruds.user.fields.current_point') }}</label>
                <input class="form-control {{ $errors->has('current_point') ? 'is-invalid' : '' }}" type="number" name="current_point" id="current_point" value="{{ old('current_point', $user->current_point) }}" step="0.01">
                @if($errors->has('current_point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('current_point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.current_point_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.user.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ic_number">{{ trans('cruds.user.fields.ic_number') }}</label>
                <input class="form-control {{ $errors->has('ic_number') ? 'is-invalid' : '' }}" type="text" name="ic_number" id="ic_number" value="{{ old('ic_number', $user->ic_number) }}">
                @if($errors->has('ic_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ic_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.ic_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_number">{{ trans('cruds.user.fields.contact_number') }}</label>
                <input class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : '' }}" type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', $user->contact_number) }}">
                @if($errors->has('contact_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.contact_number_helper') }}</span>
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
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
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
@if(isset($user) && $user->image)
      var file = {!! json_encode($user->image) !!}
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