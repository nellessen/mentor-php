<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Manage User','url'=>array('admin')),
);
?>

<div class="page-header">
  <h1>Get Started</h1>
  <p>To get started, we'll need your information.</p>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>