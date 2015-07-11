<?php

namespace Project\App\HTTPProcessors\Tracker;

class Project extends \Project\App\HTTPProcessors\Tracker
{
    public function listAction($request)
    {
        $query    = $this->orm()->query('project');
        $projects = $query->orderDescendingBy('id')->find();
        
        return $this->components->template()->render(
            'app:project/list',
            array('projects' => $projects)
        );
    }
    
    public function createAction($request)
    {
        $name    = $request->data()->getRequired('name');
        $project = $this->tracker()->createProject($name);
        
        return $this->projectRedirect($project);
    }
    
    public function viewAction($request)
    {
        $id = $request->attributes()->getRequired('id');
        
        $query   = $this->orm()->query('project');
        $project = $query->in($id)->findOne(array('tasks'));
        
        $template = $this->components->template()->get('app:project/view');
        $template->project = $project;
        return $template;
    }
        
    public function deleteAction($request)
    {
        $id = $request->data()->getRequired('id');
        
        $query   = $this->orm()->query('project');
        $project = $query->in($id)->findOne();
        
        $this->tracker()->deleteProject($project);
        
        return '';
    }
}