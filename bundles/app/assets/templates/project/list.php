<?php $this->layout('app:layout');?>

<ul class="list-group">
    <?php foreach($projects as $project): ?>
        <li class="list-group-item">
            <span class="badge badge-success">
            <?=$_($project->tasksCompleted)?>/<?=$_($project->tasksTotal)?>
            </span>
            <a href="<?=$_($this->httpPath('app', array('processor' => 'project')))?>">
                <?=$_($project->name)?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<?php $action = $this->httpPath('app', array('processor' => 'project', 'action' => 'create')); ?>
<form action="<?=$_($action)?>" method="post">
    <input type="text" name="name" class="form-control" placeholder="Project name">
    <button type="submit" class="btn btn-default">Add project</button>
</form>