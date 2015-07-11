<?php

namespace Project\App\HTTPProcessors\Tracker;

class Task extends \Project\App\HTTPProcessors\Tracker
{
    public function createAction($request)
    {
        $data      = $request->data();
        $projectId = $data->getRequired('projectId');
        $name      = $data->getRequired('name');
        
        $query   = $this->orm()->query('project');
        $project = $query->in($projectId)->findOne();
        
        $this->tracker()->addTask($project, $name);
        return $this->projectRedirect($project);
    }
    
    public function markDoneAction($request)
    {
        $task = $this->getTask($request);
        $this->tracker()->markTaskDone($task);
        
        return $task->project()->asObject();
    }
    
    public function deleteAction($request)
    {
        $task = $this->getTask($request);
        $project = $task->project();
        
        $this->tracker()->deleteTask($task);
        return $project->asObject();
    }
    
    protected function getTask($request)
    {
        $id = $request->data()->getRequired('id');
        
        $query = $this->orm()->query('task');
        return $query->in($id)->findOne();
    }
}