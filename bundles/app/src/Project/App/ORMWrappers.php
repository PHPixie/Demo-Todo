<?php

namespace Project\App;

class ORMWrappers extends \PHPixie\ORM\Wrappers\Implementation
{
    protected $databaseEntities = array(
        'task'
    );
    
    public function taskEntity($entity)
    {
        return new ORMWrappers\Task($entity);
    }
}