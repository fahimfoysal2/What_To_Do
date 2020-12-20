@extends('layouts.app')

@section('content')
<!--<div>
        <div
            class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
        >
            @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                <a
                    href="{{ url('/home') }}"
                    class="text-sm text-gray-700 underline"
                    >Home</a
                >
                @else
                <a
                    href="{{ route('login') }}"
                    class="text-sm text-gray-700 underline"
                    >Login</a
                >

                @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="ml-4 text-sm text-gray-700 underline"
                    >Register</a
                >
                @endif @endauth
            </div>
            @endif
        </div>
</div>-->

    <span style="text-align: center; color: #ff0000">
        <center>
            <span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="32"
                    height="32"
                    fill="red"
                    class="bi bi-calendar2-check"
                    viewBox="0 0 16 16"
                >
                    <path
                        fill-rule="evenodd"
                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"
                    />
                    <path
                        d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"
                    />
                    <path
                        fill-rule="evenodd"
                        d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"
                    />
                </svg>
            </span>
        </center>
        <h1>What To Do!</h1>
    </span>
    <hr />

    @auth
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('My Tasks') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- {{ __('You are logged in!') }} -->
                        @if ($tasks ?? '')
                            @foreach($tasks as $task)
                            {{ $task["id"] }} <br />
                            {{ $task["title"] }} <br />
                            {{ $task["description"] }} <br />
                            <br />
                            @endforeach
                        @else
                            {{ 'Home route, from controller, without data' }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endauth


    <!-- @auth
    <div class="container">
        @foreach($tasks as $task)
        {{ $task["id"] }} <br />
        {{ $task["title"] }} <br />
        {{ $task["description"] }} <br />

        <br />
        @endforeach
    </div>
    @endauth -->


@endsection
