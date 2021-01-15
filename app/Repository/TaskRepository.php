<?php

namespace App\Repository;

use App\Models\Task;
use App\Models\User;
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
        return User::find(Auth::id())->tasks()
            ->orderBy('status', 'asc')
            ->orderBy('created', 'asc')
            ->get();
    }



    /**
     * get only one task details of one user
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function getOneTaskOfCurrentUser($id)
    {
        // check if user is authenticated.
        $this->userAuthCheck();

        $current_user_id = Auth::id();
        return Task::where('user_id', $current_user_id)
            ->where('id', $id)
            ->first();
    }



    /**
     * @return int total number of tasks for current user
     * @throws \Exception
     */
    public function getTasksCountOfCurrentUser(): int
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
        $time = new \DateTime();
        $current_user_id = Auth::id();
        return Task::where('user_id', $current_user_id)
            ->whereDate('end_time', '>=', $time)
            ->orWhere('end_time', '=', null)
            ->where('status', '=', 0)
            ->orderBy('end_time', 'desc')
            ->take($noOfTasks)
            ->get();
    }


    /**
     * Create new Task
     * @param $task
     * @return mixed
     */
    public function createTask($task)
    {
        $created = date("Y-m-d H:i:s");
        $end_time = $task['end_time'];
        if ($end_time) {
            $end_time = (new \DateTime($task['end_time']))->format('Y-m-d H:i:s');
        }

        $userID = Auth::id();

        $task = Task::create([
            'user_id' => $userID,
            'title' => $task['title'],
            'description' => $task['description'],
            'created' => $created,
            'end_time' => $end_time
        ]);

        if (!$task) {
            throw new Exception('Failed to create new task!');
        }

        return $task;
    }



    /**
     * get one task and delete that
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function deleteTask($id): string
    {
        $task = $this->getOneTaskOfCurrentUser($id);
        if ($task) {
            $task->delete();
            return "Task Deleted";
        } else {
            return "Task not Found.";
        }
    }


    /**
     * Save updated date to database
     * @param $taskId
     * @param $dataToUpdate
     * @return boolean
     * @throws \Exception
     */
    public function saveUpdatedTask($taskId, $dataToUpdate)
    {
         return Task::where('id', $taskId)
            ->where('user_id', Auth::id())
            ->update($dataToUpdate);
    }

}
