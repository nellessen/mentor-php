<?php
$this->breadcrumbs=array(
	'Goals'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Goal','url'=>array('index')),
	array('label'=>'Create Goal','url'=>array('create')),
	array('label'=>'View Goal','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Goal','url'=>array('admin')),
);
?>

<div class="page-header">
  <h1>Update Goal <?php echo $model->id; ?></h1>
</div>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>