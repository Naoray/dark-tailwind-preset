@extends('layouts.guest')

@section('content')
  <div class="flex flex-1 flex-col items-center justify-center w-full">
    <h1 class="text-3xl text-center sm:text-5xl mt-4 font-hairline font-sans">{{ config('app.name') }}</h1>
    @if (Route::has('login'))
      <div class="flex justify-center mt-6 text-xl">
        <a class="border border-teal-500 px-4 py-2 rounded hover:text-teal-500 hover:border-gray-700 no-underline mr-6" href="{{ route('login') }}">Login</a>
        <a class="border border-gray-700 px-4 py-2 rounded no-underline hover:text-teal-500 hover:border-teal-500" href="{{ route('register') }}">Register</a>
      </div>
    @endif
  </div>
@endsection