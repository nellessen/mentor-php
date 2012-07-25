<?php
$this->breadcrumbs=array(
	'Goals'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Goal','url'=>array('index')),
	array('label'=>'Create Goal','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('goal-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="page-header">
  <h1>Manage Goals</h1>
  <p>
  You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
  or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
  </p>
</div>

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'goal-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'userId',
		'mentor1_email',
		//'mentor1_name',
		'mentor2_email',
		//'mentor2_name',
		'mentor3_email',
		//'mentor3_name',
		//'description',
		'active',
		'created',
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
