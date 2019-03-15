<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge, chrome=1">
  <meta name="renderer" content="webkit">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', config('app.name')) - Laravel</title>
  <meta name="description" content="@yield('description', 'Laravel Artisan')"/>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  @yield('styles')
</head>
<body>
<div id="app" class="{{ route_class() }}-page">
  <header id="app-header" class="bbs-header">
    @include('web.layouts.header')
  </header>
  <main id="app-main" class="bbs-main">
    <div class="container">
      @include('web.partials.message')
      @yield('content', 'Default Content')
    </div>
  </main>
  <footer id="app-footer" class="bbs-footer">
    @include('web.layouts.footer')
  </footer>
</div>

@if (app()->isLocal())
  @include('sudosu::user-selector')
@endif

<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')

</body>
</html>
