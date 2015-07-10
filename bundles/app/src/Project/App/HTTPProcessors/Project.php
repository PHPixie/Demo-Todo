<?php

namespace Project\App\HTTPProcessors;

class Project extends \PHPixie\DefaultBundle\Processor\HTTP\Actions
{
    protected $attribute = 'action';
    
    protected $builder;
    
    public function __construct($builder)
    {
        $this->builder = $builder;
    }
    
    public function indexAction($request)
    {
        $projects = $this->builder->components()->orm()->query('project')->find();
        
        $container = $this->builder->components()->template()->get('app:project/list');
        $container->set('projects', $projects);
        return $container;
    }
    
    public function createAction($request)
    {
        $project = $this->builder->components()->orm()->createEntity('project');
        
        $project->name = $request->data()->getRequired('name');
        $project->tasksTotal = 0;
        $project->tasksDone = 0;
        $project->save();
        
        return $this->projectRedirect($project);
    }
    
    public function viewAction($request)
    {
        $id = $request->attributes()->getRequired('id');
        $project = $this->builder->components()->orm()->query('project')->in($id)->findOne(array('tasks'));
        return $this->builder->components()->template()->render(
            'app:project/view',
            array(
                'project' => $project
            )
        );
    }
    
    public function createTaskAction($request)
    {
        $orm = $this->builder->components()->orm();
        $data = $request->data();
        
        $project = $orm->query('project')->in($data->getRequired('projectId'))->findOne();
        
        $task = $orm->createEntity('task');
        $task->name = $data->getRequired('name');
        $task->save();
        
        $project->tasks->add($task);
        $project->tasksTotal = $project->tasksTotal+1;
        $project->save();
        
        return $this->projectRedirect($project);
    }
    
    public function markTaskDoneAction($request)
    {
        $orm = $this->builder->components()->orm();
        $data = $request->data();
        
        $task = $orm->query('task')->in($data->getRequired('id'))->findOne();
        
        $task->isDone = true;
        $task->save();
        
        $project = $task->project();
        $project->tasksDone = $project->tasksDone+1;
        $project->save();
        
        return array(
            'tasksDone' => $project->tasksDone,
            'tasksTotal' => $project->tasksTotal
        );
    }
    
    public function deleteTaskAction($request)
    {
        $orm = $this->builder->components()->orm();
        $data = $request->data();
        
        $task = $orm->query('task')->in($data->getRequired('id'))->findOne();
        
        $project = $task->project();
        $project->tasksTotal = $project->tasksTotal-1;
        if($task->isDone) {
            $project->tasksDone = $project->tasksDone-1;
        }
        
        $project->save();
        $task->delete();
        
        return array(
            'tasksDone' => $project->tasksDone,
            'tasksTotal' => $project->tasksTotal
        );
    }
    
    protected function projectRedirect($project)
    {
        $url = $this->builder->frameworkBuilder()->http()->routeTranslator()->generatePath(
            'app.view',
            array(
                'id' => $project->id
            )
        );
        return $this->builder->components()->http()->responses()->redirect($url);
    }
}