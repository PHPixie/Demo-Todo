<?php

namespace Project\App;

class Builder extends \PHPixie\DefaultBundle\Builder
{
    public function tracker()
    {
        return $this->instance('tracker');
    }
    
    public function buildTracker()
    {
        return new Tracker(
            $this->components()->orm()
        );
    }
    
    protected function buildHttpProcessor()
    {
        return new HTTPProcessor($this);
    }
    
    protected function buildOrmWrappers()
    {
        return new ORMWrappers();
    }
    
    protected function getRootDirectory()
    {
        return realpath(__DIR__.'/../../../');
    }
    
    public function bundleName()
    {
        return 'app';
    }
}