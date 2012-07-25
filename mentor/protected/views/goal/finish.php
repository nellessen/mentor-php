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
  <h1>Ready, Steady, Go!</h1>
  <blockquote>
    <p>Almost there! You set a goal and chose your Mentors.</p>
  </blockquote>
</div>
<p>
  Once you hit "Send!", your goal will start and will<br>
  inform your Mentors about your progress for the next ten days!
</p>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
		'buttonType'=>'link',
	  'url' => array('workflow','step'=>5,'goal'=>$model->id),
    'icon'=>'arrow-right white',
		'type'=>'primary',
		'label'=>'Finish',
	)); ?>
</div>