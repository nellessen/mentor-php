<?php $this->pageTitle=Yii::app()->name; ?>

<div class="page-header">
  <h1><i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
</div>

<div class="hero-unit">
    
<h2>If you could change one thing in your life,<br>
what would it be?</h2>

<p>
  With Mentor, anyone can achieve anything.<br>
  It's a simple, straight-forward way to improve your life.<br>
  And it's 100% free
</p> 

		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'link',
		  'url' => array('user/create'),
	    //'icon'=>'arrow-right white',
			'type'=>'primary',
			'label'=> 'Let`s try it!',
	    'htmlOptions' => array('class'=>'btn-large',)
		)); ?>
</div>