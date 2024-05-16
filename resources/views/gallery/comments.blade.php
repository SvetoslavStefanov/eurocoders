<div class="row d-flex justify-content-center">
  <div class="col-md-8 col-lg-6">
    <div class="card shadow-0 border" style="background-color: #f0f2f5;">
      <div class="card-body p-4">
        @auth
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
        @endAuth

        @foreach($image->comments as $comment)
          <div class="card mb-4">
            <div class="card-body text-start">
              <p data-edit="0">{{ $comment->content }}</p>

              @if(Auth::check() && Auth::user()->id === $comment->user_id)
              <div class="d-none" data-edit="1">
                <form method="POST" action="{{ route('comments.update', $comment) }}">
                  @csrf
                  <input name="content" class="form-control" placeholder="{{ __('Type comment...') }}" value="{{ $comment->content }}">
                  <input type="hidden" name="gallery_id" value="{{ $image->id }}"/>
                  <input type="hidden" name="_method" value="PUT">
                </form>
              </div>
              @endif

              <div class="d-flex justify-content-between">
                <div class="d-flex flex-row align-items-center">
                  <p class="small mb-0 ms-2">
                    {{ __('By') }} <a href="<?=route('users.show', $comment->owner);?>"><?= $comment->owner->name; ?></a>,
                    <span class="small text-muted">
                      {{ $comment->created_at->diffForHumans() }}
                    </span>
                  </p>
                </div>

                <div class="d-flex flex-row align-items-center">
                  @if(Auth::check() && Auth::user()->id === $comment->user_id)
                    <div class="danger text-bg-danger p-1" onclick="event.preventDefault(); document.getElementById('comments-form-' + {{ $comment->id }}).submit();">
                      {{ __('Delete') }}
                    </div>
                    <div class="vr mx-1"></div>
                    <div class="red text-bg-warning p-1" onclick="showTextArea(event);">
                      {{ __('Edit') }}
                    </div>

                    @include('partials.destroy-item', [
                            'url' => route('comments.destroy', $comment),
                            'previous_page' => url()->previous(),
                            'name' => 'comments-form-' . $comment->id,
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

<script type="text/javascript">
    const showTextArea = (e) => {
      e.target.closest('.card-body').querySelectorAll('[data-edit]').forEach((item) => {
        item.classList.toggle('d-none');
      });
    };
</script>
