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
                            <div class="task">
                                <div class="row">
                                    <div class="col">
                                        <span class="task_title">{{ $task["title"] }}</span>

                                        <span class="task_actions">
                                            <a href="{{route('task.edit', ['id'=>$task->id])}}">&#128295;</a>
                                            |
                                            <a href="{{route('task.delete', ['id'=>$task->id])}}">&#10060;</a>
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="end_time">{{$task["end_time"] ?? '' }}</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">{{ $task["description"] }}</div>
                                </div>
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
