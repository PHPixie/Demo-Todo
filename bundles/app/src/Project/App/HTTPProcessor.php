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
        $components = $this->builder->components();
        
        return new HTTPProcessors\Project(
            $this->builder
        );
    }
}