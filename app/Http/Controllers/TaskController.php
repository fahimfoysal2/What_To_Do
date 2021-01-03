<?php

namespace App\Http\Controllers;
use App\Repository\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->middleware('auth');
        $this->taskRepository = $taskRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function tasksList()
    {
        $tasks = $this->taskRepository->getTasksOfCurrentUser();
        return view('home', compact('tasks'));
    }

    /**
     * show one task
     * @param $id
     * @throws \Exception
     */
    public function showOneTask($id)
    {
        $task = $this->taskRepository->getOneTaskOfCurrentUser($id);
        return view('tasks.oneTaskView', compact('task'));
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

    /**
     * delete task via id and redirect back
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteTask($id)
    {
        $result = $this->taskRepository->deleteTask($id);
        Session::flash('status', $result);
        return redirect()->back();
    }

    /**
     * Allow user to edit the task
     */
    public function editTask()
    {

    }
}
