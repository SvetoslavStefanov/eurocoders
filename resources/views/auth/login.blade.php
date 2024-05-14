@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 py-5">
                <?=view('auth.partials.login');?>
            </div>
        </div>
    </div>
@endsection
