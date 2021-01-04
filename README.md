App Name........: **What To Do!**  
Description.......: **A simple to-do app**
<hr>   

Used Technologies:
1. Laravel
2. Bootstrap 
3. MySQL  

<hr>

Environment:   
1. WSL2
2. Docker
3. Nginx  


<hr>

Routes:

route | name | action
----- | ---- | -----
/                   | welcome        | shows recent(default 5) tasks
home                | home           | shows all tasks
task                | task.all       | all tasks
task/create         | task.create    | create new task
task/{id}           | task.view      | view single task via ID
task/{id}/complete  | task.view      | mark task as Completed
task/{id}/delete    | task.delete    | delete single task
task/{id}/edit      | task.edit      | edit single task
task/{id}/update    | task.update    | update a task
login               | Login
register            | register
password/reset      | reset pass 
