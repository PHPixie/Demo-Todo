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
        $project->tasksCompleted = 0;
        $project->save();
        
        return $this->projectRedirect($project);
    }
    
    public function viewAction($request)
    {
        $project = $this->builder->components()->orm()->query('project')->findOne(array('tasks'));
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
        
        $project = $orm->query('project')->in($data->getRequired('project_id'))->findOne();
        
        $task = $orm->createEntity('task');
        $task->name = $data->getRequired('name');
        $task->save();
        
        $project->tasks->add($task);
        $project->tasksTotal = $project->tasksTotal+1;
        $project->save();
        
        return $this->projectRedirect($project);
    }
    
    protected function projectRedirect($project)
    {
        $url = $this->builder->frameworkBuilder()->http()->routeTranslator()->generatePath(
            'app.default',
            array(
                'processor' => 'project',
                'action'    => 'view',
            )
        );
        return $this->builder->components()->http()->responses()->redirect($url);
    }
}