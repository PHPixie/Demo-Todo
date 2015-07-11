<?php

namespace Project\App;

class ORMWrappers extends \PHPixie\ORM\Wrappers\Implementation
{
    protected $databaseEntities = array(
        'project'
    );
    
    public function projectEntity($entity)
    {
        return new ORMWrappers\Project\Entity($entity);
    }
}