<?php

namespace Project\App;

class ORMWrappers extends \PHPixie\ORM\Wrappers\Implementation
{
    protected $databaseEntities = array(
        'task',
        'project'
    );
    
    public function taskEntity($entity)
    {
        return new ORMWrappers\Task($entity);
    }
    
    public function projectEntity($entity)
    {
        return new ORMWrappers\Project($entity);
    }
}