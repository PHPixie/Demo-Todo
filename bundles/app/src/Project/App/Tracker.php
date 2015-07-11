<?php

namespace Project\App;

class Tracker
{
    protected $orm;
    
    public function __construct($orm) {
        $this->orm = $orm;
    }
    
    public function createProject($name)
    {
        $project = $this->orm->repository('project')->create();
        
        $project->name = $name;
        $project->save();
        
        return $project;
    }
    
    public function addTask($project, $taskName)
    {
        $task = $this->orm->repository('task')->create();
        
        $task->name = $taskName;
        $task->save();
        
        $project->tasksTotal = $project->tasksTotal+1;
        $project->save();
        
        $project->tasks->add($task);
        
        return $task;
    }
    
    public function markTaskDone($task)
    {
        $task->isDone = true;
        $task->save();
        
        $project = $task->project();
        $project->tasksDone = $project->tasksDone+1;
        $project->save();
    }
    
    public function deleteProject($project)
    {
        $project->delete();
    }
    
    public function deleteTask($task)
    {
        $project = $task->project();
        
        $project->tasksTotal = $project->tasksTotal-1;
        if($task->isDone) {
            $project->tasksDone = $project->tasksDone-1;
        }
        
        $project->save();
        $task->delete();
    }
}