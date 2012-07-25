<?php
$this->breadcrumbs=array(
	'Activities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Activity','url'=>array('index')),
	array('label'=>'Manage Activity','url'=>array('admin')),
);
?>

<div class="page-header">
  <h1>Set your activity!</h1>
  <h2>Reaching a goal is done through daily action. </h2>
  <blockquote>
    <p>What could you do every day to get there? 10 push-ups?<br> Send one application? Learn 15 new Spanish words?</p>
  </blockquote>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'goals'=>$goals)); ?>