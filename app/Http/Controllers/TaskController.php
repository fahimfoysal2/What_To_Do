<?php

namespace App\Http\Controllers;
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \Illuminate\Validation\ValidationException
     * @todo end time after now / today -> validate
     */
    public function saveTask(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'end_time' => 'nullable|date|after:now'
        ]);

        $savedtask = $this->taskRepository->createTask($request->except('_token'));

        if ($savedtask){
            return redirect('/');
        }else{
            return abort('500', 'can not save tha task');
        }

    }
}
