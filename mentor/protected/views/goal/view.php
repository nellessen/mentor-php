<?php
$this->breadcrumbs=array(
	'Goals'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Goal','url'=>array('index')),
	array('label'=>'Create Goal','url'=>array('create')),
	array('label'=>'Update Goal','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Goal','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Goal','url'=>array('admin')),
);
?>


<div class="page-header">
  <h1>Goal: <em><?php echo $model->description; ?></em></h1>
  <p>View information about this goal.</p>
</div>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'mentor1_email',
		'mentor1_name',
		'mentor2_email',
		'mentor2_name',
		'mentor3_email',
		'mentor3_name',
		'description',
		'active',
		'created',
	),
)); ?>
