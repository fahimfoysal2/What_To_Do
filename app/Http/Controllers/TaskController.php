<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Repository\TaskRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->middleware('auth');
        $this->taskRepository = $taskRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function tasksList()
    {
        $tasks = $this->taskRepository->getTasksOfCurrentUser();
        return view('home', compact('tasks'));
    }

    public function createTask()
    {
        return view('tasks.createTask');
    }

    /**
     * @todo end time after now / today -> validate
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function saveTask(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'end_time' => 'nullable|date|after:now'
        ]);

        $savedtask = $this->taskRepository->createTask($request->except('_token'));

        if ($savedtask){
            return redirect('home');
        }else{
            return abort('500');
        }

    }
}
