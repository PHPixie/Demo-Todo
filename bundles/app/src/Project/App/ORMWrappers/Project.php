<?php

namespace Project\App\ORMWrappers;

class Project extends \PHPixie\ORM\Wrappers\Type\Database\Entity
{
    public function isDone()
    {
        return $this->tasksDone === $this->tasksTotal;
    }
}