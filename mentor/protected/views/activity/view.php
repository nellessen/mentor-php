<?php
$this->breadcrumbs=array(
	'Activities'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Activity','url'=>array('index')),
	array('label'=>'Create Activity','url'=>array('create')),
	array('label'=>'Update Activity','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Activity','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Activity','url'=>array('admin')),
);
?>

<div class="page-header">
  <h1>Activity: <em><?php echo $model->description; ?></em></h1>
  <p>View information about this activity.</p>
</div>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'userId',
		'goalId',
		'description',
		'day',
		'status',
	),
)); ?>
