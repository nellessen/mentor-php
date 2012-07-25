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
  <h1>Choose your mentors!</h1>
  <h2>Who can support you as a mentor?</h2>
  <blockquote>
    <p>To make sure that you stay on track, we will inform your friends<br>
     once a day whether you reached your daily goal or not.<br>
     Who would you like to be your mentor?</p>
  </blockquote>
</div>

<?php echo $this->renderPartial('_formMentors', array('model'=>$model)); ?>