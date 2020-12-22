<?php

namespace App\Repository;

use App\Models\Task;
use App\Traits\AuthTrait;
use Illuminate\Support\Facades\Auth;
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
        return Task::where('id', $current_user_id)
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

}
