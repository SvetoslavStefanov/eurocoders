@extends('layouts.main')
@section('title', 'Home')
@section('content')
  <div class="row my-5">
    <div class="card col-3 mx-auto">
      <div class="card-header">{{ __('Upload an image') }}</div>

      <div class="card-body">
        <form method="POST" action="{{ route('gallery.store') }}" enctype="multipart/form-data">
          @csrf

          <div class="row mb-3">
            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Select image') }}</label>

            <div class="col-md-6">
              <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/png, image/gif, image/jpeg">

              @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection