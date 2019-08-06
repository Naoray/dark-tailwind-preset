<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ mix('js/app.js') }}" defer></script>
  </head>
  <body class="font-sans leading-tight @yield('body-colors', 'text-white bg-black')">
    <div id="app" class="min-h-screen flex flex-col justify-center items-center">
      @yield('header')

      @yield('content')
      
      @yield('footer')
  </body>
</html>