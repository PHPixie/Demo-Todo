<?php

namespace Project\App;

class HTTPProcessor extends \PHPixie\DefaultBundle\Processor\HTTP\Builder
{
    protected $builder;
    protected $attribute = 'processor';
    
    public function __construct($builder)
    {
        $this->builder = $builder;
    }
    
    protected function buildProjectProcessor()
    {
        return new HTTPProcessors\Tracker\Project(
            $this->builder
        );
    }
    
    protected function buildTaskProcessor()
    {
        return new HTTPProcessors\Tracker\Task(
            $this->builder
        );
    }
}