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

    @auth
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('My Recent Tasks') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                        <!-- {{ __('You are logged in and have tasks') }} -->
                            @if (count($tasks) > 0)
                                @foreach($tasks as $task)
                                    {{'Due :'.$task["end_time"] }} <br/>
                                    {{ $task["title"] }} <br/>
                                    {{ $task["description"] }}
                                    <hr>
                                @endforeach
                            @else
                                <b>Task 0 :</b> Create a new Task, Now!!
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    @guest
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('My Tasks') }}</div>

                        <div class="card-body">
                        <!-- {{ __('Guest Section!') }} -->
                            <ol>
                                <li>
                                    <a href="{{ route('register') }}">Create Account</a> or,
                                    <a href="{{ route('login') }}">Login Here</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth

@endsection
