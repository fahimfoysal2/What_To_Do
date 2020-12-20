@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <!-- {{ __('You are logged in and have tasks') }} -->
                    @if (count($tasks) > 0)
                        @foreach($tasks as $task)
                            {{ $task["id"] }} <br/>
                            {{ $task["title"] }} <br/>
                            {{ $task["description"] }} <br/>
                            <br/>
                        @endforeach
                    @else
                        <b>Task 0 :</b> Create a new Task, Now!!
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
