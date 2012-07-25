<?php
$this->breadcrumbs=array(
	'Goals',
);

$this->menu=array(
	array('label'=>'Create Goal','url'=>array('create')),
	array('label'=>'Manage Goal','url'=>array('admin')),
);
?>

<div class="page-header">
  <h1>Your Goals</h1>
  <p>A list of all your goals.</p>
</div>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
