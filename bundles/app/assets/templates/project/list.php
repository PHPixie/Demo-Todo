<?php $this->layout('app:layout');?>

<ul class="list-group">
    <?php foreach($projects as $project): ?>
        <li class="project list-group-item <?=$project->isDone()?'done':''; ?>">
            <span>
                <span class="counter badge badge-success">
                    <?=$_($project->tasksDone)?>
                    /
                    <?=$_($project->tasksTotal)?>
                </span>
            </span>
            <a href="<?=$_($this->httpPath('app.view', array('processor' => 'project', 'action' => 'view', 'id' => $project->id)))?>">
                <?=$_($project->name)?>
            </a>
            <i class="delete fa fa-close fa-lg pull-right"></i>
        </li>
    <?php endforeach; ?>
</ul>

<?php $action = $this->httpPath('app.default', array('processor' => 'project', 'action' => 'create')); ?>
<form action="<?=$_($action)?>" method="post">
    <div class="form-group">
        <input type="text" name="name" class="form-control" placeholder="Project name">
    </div>
    <button type="submit" class="btn btn-primary">Add project</button>
</form>