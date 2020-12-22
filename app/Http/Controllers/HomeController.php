<?php

namespace App\Http\Controllers;

use App\Repository\TaskRepository;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    private $taskRepository;

    /**
     * Create a new controller instance.
     *
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->middleware('auth');
        $this->taskRepository = $taskRepository;
    }

    /**
     * Returns all tasks of current user
     * @return Renderable
     * @throws \Exception
     */
    public function home()
    {
        $tasks = $this->taskRepository->getTasksOfCurrentUser();
        return view('home', compact('tasks'));
    }
}
