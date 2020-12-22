<?php

namespace App\Repository;

use App\Models\Task;
use App\Traits\AuthTrait;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\Types\Collection;

class TaskRepository
{
    // adding AuthTrait for user verification
    use AuthTrait;

    /**
     * @return Collection collection of tasks for current user in asc order by end time
     * @throws \Exception
     */
    public function getTasksOfCurrentUser()
    {
        // check if user is authenticated.
        $this->userAuthCheck();

        $current_user_id = Auth::id();
        return Task::where('user_id', $current_user_id)
            ->orderBy('end_time', 'asc')
            ->get();
    }

    /**
     * @return int total number of tasks for current user
     * @throws \Exception
     */
    public function getTasksCountOfCurrentUser()
    {
        return count($this->getTasksOfCurrentUser());
    }


    /**
     * @param int $noOfTasks
     * @return Collection collection of requested number of tasks, default 5
     * @throws \Exception
     */
    public function getRecentTasksOfCurrentUser($noOfTasks = 5)
    {
        return $this->getTasksOfCurrentUser()->take($noOfTasks);
    }

    public function createTask($task)
    {
        $created = date("Y-m-d H:i:s");
        $end_time = $task['end_time'];
        if ($end_time) {
            $end_time = (new \DateTime($task['end_time']))->format('Y-m-d h:i:s');
        }

        $userID = Auth::id();

//        dd($end_time);

        $task = Task::create([
            'user_id' => $userID,
            'title' => $task['title'],
            'description' => $task['description'],
            'created' => $created,
            'end_time' => $end_time
        ]);

        if (!$task){
            throw new Exception('Failed to create new task!');
        }

        return $task;
    }

}
