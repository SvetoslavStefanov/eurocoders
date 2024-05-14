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

    <hr class="mt-5 my-5"/>

    <div class="row">
      <div class="col-3 hstack gap-3 mx-auto">
        <h3 data-sign-action="login">Login</h3>
        <div class="vr"></div>
        <h3 data-sign-action="register">Sign Up</h3>
      </div>

      <div class="row mt-4 py-5">
        <form data-sign="login" class="col-3 mx-auto d-none">
          <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required="required">
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
          </div>

          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        </form>

        <form data-sign="register" class="col-3 mx-auto d-none">
          <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required="required">
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
          </div>

          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Confirm Password" required="required">
            <label for="floatingPassword">Confirm Password</label>
          </div>

          <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Sign Up</button>
        </form>
      </div>
    </div>

  </div>

@endsection

@section('scripts')
  <script type="text/javascript">
    document.querySelectorAll('h3[data-sign-action]').forEach((item) => {
      item.addEventListener('click', (e) => {
        document.querySelectorAll('form[data-sign]').forEach((form) => {
          form.classList.add('d-none');

          if (form.dataset.sign === e.target.dataset.signAction) {
            form.classList.toggle('d-none');
          }
        });
      });
    });
  </script>
@endsection