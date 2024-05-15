<div class="row d-flex justify-content-center">
  <div class="col-md-8 col-lg-6">
    <div class="card shadow-0 border" style="background-color: #f0f2f5;">
      <div class="card-body p-4">
        <div class="form-outline mb-4">
          <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            <input name="content" type="text" class="form-control {{ $errors->any() ? 'is-invalid' : '' }}" placeholder="{{ __('Type comment...') }}"  value="{{ old('content') }}"/>
            <input type="hidden" name="gallery_id" value="{{ $image->id }}"/>

            @if($errors->any())
              @foreach ($errors->all() as $error)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $error }}</strong>
                </span>
              @endforeach
            @endif
          </form>
        </div>

        @foreach($image->comments as $comment)
          <div class="card mb-4">
            <div class="card-body text-start">
              <p>{{ $comment->content }}</p>

              <div class="d-flex justify-content-between">
                <div class="d-flex flex-row align-items-center">
                  <p class="small mb-0 ms-2">
                    <a href="<?=route('users.show', $comment->owner);?>"><?= $comment->owner->name; ?></a>
                  </p>
                </div>

                <div class="d-flex flex-row align-items-center">
                  @if(Auth::check() && Auth::user()->id === $comment->user_id)
                    <span class="danger text-red-500" onclick="event.preventDefault(); document.getElementById('comments-form').submit();">
                      {{ __('Delete') }}
                    </span>

                    @include('partials.destroy-item', [
                            'url' => route('comments.destroy', $comment),
                            'previous_page' => url()->previous(),
                            'name' => 'comments-form'
                            ])
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>