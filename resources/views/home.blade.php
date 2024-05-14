@extends('layouts.main')
@section('title', 'Home')
@section('content')

  <div class="container py-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <div class="col">
        <div class="card shadow-sm">
          <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
            <rect width="100%" height="100%" fill="#55595c"></rect>
            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
          </svg>
        </div>
      </div>
    </div>

    @guest
    <hr class="mt-5 my-5"/>

    <div class="row">
      <div class="col-3 hstack gap-3 mx-auto">
        <h3 data-sign-action="login">Login</h3>
        <div class="vr"></div>
        <h3 data-sign-action="register">Sign Up</h3>
      </div>

      <div class="row mt-4 py-5">
        <div data-sign="login" class="col-4 mx-auto d-none">
          <?=view('auth.partials.login');?>
        </div>

        <div data-sign="register" class="col-4 mx-auto d-none">
          <?=view('auth.partials.register');?>
        </div>
      </div>
    </div>

    @endguest
  </div>

@endsection

@section('scripts')
  <script type="text/javascript">
    document.querySelectorAll('h3[data-sign-action]').forEach((item) => {
      item.addEventListener('click', (e) => {
        document.querySelectorAll('[data-sign]').forEach((form) => {
          form.classList.add('d-none');

          if (form.dataset.sign === e.target.dataset.signAction) {
            form.classList.toggle('d-none');
          }
        });
      });
    });
  </script>
@endsection