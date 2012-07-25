<?php
$this->breadcrumbs=array(
	'Activities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Activity','url'=>array('index')),
	array('label'=>'Create Activity','url'=>array('create')),
	array('label'=>'View Activity','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Activity','url'=>array('admin')),
);
?>


<div class="page-header">
  <h1>Update Activity <?php echo $model->id; ?></h1>
</div>

<?php echo $this->renderPartial('_form',array('model'=>$model, 'goals'=>$goals)); ?>