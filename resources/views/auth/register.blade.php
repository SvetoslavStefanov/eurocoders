@extends('layouts.main')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 py-5">
        <?=view('auth.partials.register');?>
      </div>
    </div>
  </div>
@endsection
