<!DOCTYPE html>
<html lang="{{ \App::getLocale() }}" class="no-js">

<head>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <title>Eurocoders</title>
  @yield('styles')
</head>

<body class="inner-pages">
<div id="wrapper">
  @include('partials.header')

  @yield('content')

  @include('partials.footer')
</div>
@yield('scripts')
</body>
</html>
