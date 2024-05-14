<!DOCTYPE html>
<html lang="{{ \App::getLocale() }}" class="no-js">

<head>
  <base href="/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <title>{{ config('app.name', 'Laravel') }}</title>
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
