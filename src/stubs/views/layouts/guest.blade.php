@extends('layouts.app')

@section('header')
<header class="container w-full max-w-2xl mx-auto py-8 px-6 flex justify-between items-center absolute">
  <div class="">
    <a href="/" class="text-2xl font-sans font-hairline text-white hover:text-teal-500 no-underline">{{ config('app.name') }}</a>
  </div>
</header>
@endsection