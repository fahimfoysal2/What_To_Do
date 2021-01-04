<?php

use App\Models\Task;

if (! function_exists('getCurrentTime' )){

    /**
     * Get current time
     * @return string
     */
    function getCurrentTime(){
        return (new \DateTime())->format('Y-m-d H:i:s');
    }
}


if (! function_exists('getTaskStatus' )){

    /**
     * Get status of a Task
     * @param Task $task
     * @return string
     */
    function getTaskStatus(Task $task){
        if ($task->end_time < getCurrentTime()){
            return array_search(config('enums.task_status.Expired'), config('enums.task_status'));
        }

        return array_search($task->status, config('enums.task_status'));
    }
}
