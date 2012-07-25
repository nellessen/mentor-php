<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'activity-form',
	'enableAjaxValidation'=>false,
  'type'=>'inline',
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row-fluid">
	  <div class="span6">
      <h3>For the next ten days, every day I will ...</h3>
    </div>
    <div class="span6">
	    <?php echo $form->textFieldRow($model,'description',array('class'=>'input-xlarge', 'maxlength'=>256)); ?>
    </div>
  </div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'link',
	    'icon'=>'arrow-left white',
	    'url'=>array('/goal/workflow', 'goal' => $goal->id),
			'label'=>'Back',
		)); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
	    'icon'=>'arrow-right white',
			'type'=>'primary',
			'label'=> 'Next',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
