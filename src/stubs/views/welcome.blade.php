@extends('layouts.guest')

@section('content')
  <div class="flex flex-1 flex-col items-center justify-center">
    <h1 class="text-5xl mt-4 font-hairline text-teal font-sans">Make your dreams come true.</h1>
    @if (Route::has('login'))
      <div class="flex justify-center mt-6 text-xl">
        <a class="border border-teal-lighter px-4 py-2 rounded text-white hover:text-teal-lighter hover:border-white no-underline mr-6" href="{{ route('login') }}">Login</a>
        <a class="border border-white px-4 py-2 rounded text-white no-underline hover:text-teal-lighter hover:border-teal-lighter" href="{{ route('register') }}">Register</a>
      </div>
    @endif
  </div>
@endsection