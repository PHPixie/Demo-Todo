<?php $this->layout('app:layout');?>

<?php $this->startBlock('head');?>
    <script src="/bundles/app/tasks.js"></script>
    <script>
        $(function() {
            tasks.init({
                doneUrl: "<?=$this->httpPath(
                    'app.default',
                    array(
                        'processor' => 'task',
                        'action'    => 'markDone'
                    )
                )?>",
                
                deleteUrl: "<?=$this->httpPath(
                    'app.default',
                    array(
                        'processor' => 'task',
                        'action'    => 'delete'
                    )
                )?>"
            });
        });
    </script>
<?php $this->endBlock(); ?>

<div id="projectTasks" class="<?=$project->isDone()?'done':''; ?>">
    <h4>
        <?=$_($project->name)?>
        <span class="counter badge">
            <span class="tasksDone"><?=$_($project->tasksDone)?></span>
            /
            <span class="tasksTotal"><?=$_($project->tasksTotal)?></span>
        </span>
    </h4>

    <ul class="list-group tasks">
        <?php foreach($project->tasks() as $task): ?>
            <li class="task list-group-item <?=$task->isDone?'done':''; ?>" data-id="<?=$task->id?>">
                <i class="icon fa fa-lg"></i>
                <span>
                    <?=$_($task->name)?>
                </span>
                <i class="delete fa fa-close fa-lg pull-right"></i>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<hr/>
<?php $action = $this->httpPath('app.default', array('processor' => 'task', 'action' => 'create')); ?>
<form action="<?=$_($action)?>" method="post">
    <input type="hidden" name="projectId" value="<?=$_($project->id)?>">
    <div class="form-group">
        <input type="text" name="name" class="form-control" placeholder="Task name">
    </div>
    <button type="submit" class="btn btn-primary">Add task</button>
</form>

<hr/>
<a href="<?=$this->httpPath('app.default')?>" class="small"><i class="icon fa fa-lg fa-chevron-left"></i> Back to Projects</a>