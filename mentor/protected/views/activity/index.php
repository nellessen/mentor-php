<?php
$this->breadcrumbs=array(
	'Activities',
);

$this->menu=array(
	array('label'=>'Create Activity','url'=>array('create')),
	array('label'=>'Manage Activity','url'=>array('admin')),
);
?>

<div class="page-header">
  <h1>Your Activities</h1>
  <p>A list of all your activities.</p>
</div>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
