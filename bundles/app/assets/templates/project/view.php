<?php $this->layout('app:layout');?>

<?php $this->startBlock('head'); ?>
    <script src="/bundles/app/tasks.js"></script>
<?php $this->endBlock(); ?>

<h4>
    <?=$_($project->name)?>
    <span class="badge badge-success">
        <?=$_($project->tasksCompleted)?>/<?=$_($project->tasksTotal)?>
    </span>
</h4>

<ul class="list-group">
    <?php foreach($project->tasks() as $task): ?>
        <li class="list-group-item">
            <?php if($task): ?>
                <i class="fa fa-check-circle fa-lg success"></i>
            <?php else: ?>
                <i class="fa fa-circle-o fa-lg"></i>
            <?php endif; ?>
            <?=$_($task->name)?>
        </li>
    <?php endforeach; ?>
</ul>

<?php $action = $this->httpPath('app.default', array('processor' => 'project', 'action' => 'createTask')); ?>
<form action="<?=$_($action)?>" method="post">
    <input type="hidden" name="project_id" value="<?=$_($project->id)?>">
    <div class="form-group">
        <input type="text" name="name" class="form-control" placeholder="Task name">
    </div>
    <button type="submit" class="btn btn-primary">Add task</button>
</form>