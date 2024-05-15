@extends('layouts.main')
@section('title', 'Home')
@section('content')
<main>
  <div class="w-100">
    <div class="bg-dark py-3 px-3 text-center text-white overflow-hidden">
      <div class="my-3 py-3">
        <p class="lead">{{ __('By') }}: <a href="<?=route('users.show', $image->owner);?>"><?=$image->owner->name;?></a></p>
        <p class="lead">{{ __('On') }}: {{ $image->created_at->format('F j, Y') }}</p>

        @if(Auth::check() && Auth::user()->id === $image->user_id)
          <p class="lead">{{ __('Action') }}:
            <span class="btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
              {{ __('Delete image') }}
            </span>
          </p>

          <form id="delete-form" action="{{ route('gallery.destroy', $image) }}" method="POST" class="d-none" onsubmit="return confirm('{{ __('Are you sure?') }}');">
            <input type="hidden" name="_method" value="DELETE">
            @csrf
          </form>
        @endif
      </div>
      <div class="bg-light shadow-sm mx-auto" style="width: 80%; border-radius: 21px 21px 0 0;">
        <img src="<?=$image->fullPath;?>" class="bd-placeholder-img card-img-top" />
      </div>

      <div class="my-3 py-3">
        <p class="lead">{{ __('Comments') }}: 3</p>
      </div>
    </div>
  </div>
</main>
@endsection