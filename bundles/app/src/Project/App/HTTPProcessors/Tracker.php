<?php

namespace Project\App\HTTPProcessors;

abstract class Tracker extends \PHPixie\DefaultBundle\Processor\HTTP\Actions
{
    protected $builder;
    protected $components;
    
    public function __construct($builder)
    {
        $this->builder    = $builder;
        $this->components = $builder->components();
    }
    
    protected function tracker()
    {
        return $this->builder->tracker();
    }
    
    protected function orm()
    {
        return $this->components->orm();
    }
    
    protected function projectRedirect($project)
    {
        $httpTranslator = $this->builder->frameworkBuilder()->http()->routeTranslator();
        $path = $httpTranslator->generatePath(
            'app.view',
            array('id' => $project->id)
        );
        
        $httpResponses = $this->components->http()->responses();
        return $httpResponses->redirect($path);
    }
}