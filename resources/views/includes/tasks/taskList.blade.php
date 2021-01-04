<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __($pageTitle ?? 'Task List') }}
                    <span style="float: right">
                        <a href="{{route('task.create')}}">&#10133;</a>
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <!-- {{ __('You are logged in and have tasks') }} -->
                    @if (count($tasks) > 0)
                        @foreach($tasks as $task)
                            @php
                                $task_status = getTaskStatus($task);
                                $task_expired = taskExpiredStatus($task);
                            @endphp
                            <div class="task">
                                <div class="row">
                                    <div class="col">
                                        <span class="task_title text-capitalize">{{ $task["title"] }}</span>

                                        <span class="task_actions">
                                            @if($task_status !== "Completed")
                                                <a href="{{route('task.complete', ['id'=> $task->id])}}"><span
                                                        id="tick-mark">&#10004;</span></a>
                                                |
                                            @endif
                                            <a href="{{route('task.edit', ['id'=>$task->id])}}">&#128295;</a>
                                            |
                                            <a href="{{route('task.delete', ['id'=>$task->id])}}">&#10060;</a>
                                        </span>
                                    </div>
                                </div>

                                @if($task->end_time)
                                    <div class="row">
                                        <div class="col">
                                            <div class="end_time">
                                                <span class="badge task-{{$task_status}}">{{$task_status}}</span>

                                                <span
                                                    class="badge task-{{$task_expired}}">{{$task_expired}}</span>: {{date('h:ia, D, d M Y ', strtotime($task->end_time))}}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="badge task-{{$task_status}}">{{$task_status}}</span>
                                @endif

                                @if($task->description)
                                    <div class="row">
                                        <div class="col">
                                            <div class="description">
                                                {{$task->description}}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <b>Task 0 :</b> <a href="{{route('task.create')}}">Create a new Task</a>, Now!!
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
