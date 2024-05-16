@extends('layouts.main')
@section('title', 'Gallery')
@section('content')
  <div class="container py-5">
      {{ view('partials.gallery', ['images' => $images]) }}

    <div class="mt-5">
      {!! $images->links() !!}
    </div>
  </div>
@endsection