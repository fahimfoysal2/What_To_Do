<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __($pageTitle ?? 'Task List') }}
                    <span>+</span>
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
                            {{'Due :'.$task["end_time"] }} <br/>
                            {{ $task["title"] }} <br/>
                            {{ $task["description"] }}
                            <hr>
                        @endforeach
                    @else
                        <b>Task 0 :</b> <a href="{{route('task.create')}}">Create a new Task</a>, Now!!
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
