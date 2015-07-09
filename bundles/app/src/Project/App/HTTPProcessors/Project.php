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
        
        $url = $this->builder->frameworkBuilder()->http()->routeTranslator()->generatePath(
            'app',
            array(
                'processor' => 'project',
                'action'    => 'view',
            )
        );
        return $this->builder->components()->http()->responses()->redirect($url);
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
}