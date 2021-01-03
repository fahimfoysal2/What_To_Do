@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if($task)
                        <div class="card-header">
                            {{ $task->title ?? 'Not Found'}}
                            <span class="task_actions">
                                <a href="{{route('task.edit', ['id'=>$task->id])}}">&#128295;</a>
                                |
                                <a href="{{route('task.delete', ['id'=>$task->id])}}">&#10060;</a>
                            </span>
                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col">
                                    <div class="end_time">{{$task->end_time ?? '' }}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">{{ $task->description ??'' }}</div>
                            </div>
                        </div>
                    @else
                        <div class="card-header">
                            {{ "Task Not Found" }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
