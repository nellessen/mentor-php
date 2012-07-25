<?php
$this->breadcrumbs=array(
	'Goals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Goal','url'=>array('index')),
	array('label'=>'Manage Goal','url'=>array('admin')),
);
?>

<div class="page-header">
  <h1>Let's set your goal!</h1>
  <h2>To improve our lives, we need to set goals.</h2>
  <blockquote>
    <p>A goal can be anything, from losing weight<br> to finding a job to learning Spanish.</p>
  </blockquote>
</div>

<?php echo $this->renderPartial('_formGoal', array('model'=>$model)); ?>