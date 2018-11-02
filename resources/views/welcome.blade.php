@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
            @auth
            @else
                <a href="{{ route('login') }}">Login</a>

                    <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>


    </div>
@endsection
