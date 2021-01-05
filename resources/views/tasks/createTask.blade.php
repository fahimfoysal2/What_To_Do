@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-{{$theme_name ?? 'light'}}">
                    <div class="card-header bg-light">{{ __('Create Task') }}</div>

                    <div class="card-body bg-{{$theme_name ?? 'light'}} text-success">
                        @include('includes.tasks.taskForm')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
