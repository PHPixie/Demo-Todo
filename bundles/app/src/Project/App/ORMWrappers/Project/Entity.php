<?php

namespace Project\App\ORMWrappers\Project;

class Entity extends \PHPixie\ORM\Wrappers\Type\Database\Entity
{
    public function isDone()
    {
        return $this->tasksDone === $this->tasksTotal;
    }
}