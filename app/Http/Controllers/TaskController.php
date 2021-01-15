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
            'description' => 'nullable|max:500',
            'end_time' => 'nullable|date|after:now'
        ]);

        $savedtask = $this->taskRepository->createTask($request->except('_token'));

        if ($savedtask) {
            return redirect(route('task.all'));
        } else {
            return abort('500', 'can not save tha task');
        }

    }

    /**
     * delete task via id and redirect back
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deleteTask($id)
    {
        $result = $this->taskRepository->deleteTask($id);
        Session::flash('status', $result);
        return redirect()->back();
    }

    /**
     * Show user form to edit the task
     * @param $id
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function editTask($id)
    {
        $task = $this->taskRepository->getOneTaskOfCurrentUser($id);
        if ($task) {
            return view('tasks.editTask', compact('task'));
        } else {
            return view('tasks.oneTaskView', compact('task'));
        }
    }


    /**
     * Update Tasks
     * @param $taskId
     * @param Request $request
     */
    public function updateTask($taskId, Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:500',
            'end_time' => 'nullable|date|after:now'
        ]);

        $status = $this->taskRepository->saveUpdatedTask($taskId, $validated);
        if ($status) {
            Session::flash('status', "Task updated Successfully");
            return redirect(route('task.all'));
        } else {
            Session::flash('status', "Failed to update Task");
            return redirect()->back();
        }
    }

    /**
     * update task status as completed
     * @param $taskId
     */
    public function completeTask($taskId)
    {
        $updateStatus = $this->taskRepository->saveUpdatedTask($taskId, [
            'status' => config('enums.task_status.Completed')
        ]);

        if ($updateStatus) {
            Session::flash('status', "Task Marked as Completed");
        } else {
            Session::flash('status', "Failed to update Task");
        }
        return redirect()->back();
    }
}
