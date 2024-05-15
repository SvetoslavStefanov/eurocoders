@extends('layouts.main')
@section('title', 'Home')
@section('content')

  <div class="container py-5">
    @foreach($images as $image)
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
            <a href="<?=route('gallery.show', $image);?>">
              <img src="<?=$image->thumb;?>" class="bd-placeholder-img card-img-top" />
            </a>
          </div>
        </div>
      </div>
    @endforeach

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