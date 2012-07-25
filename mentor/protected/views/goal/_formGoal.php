<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'goal-form',
	'enableAjaxValidation'=>false,
  'type'=>'inline',
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<p><strong>Please complete the following sentence:</strong></p>
	
	<div class="row-fluid">
	  <div class="span4">
      <h3>My life would be better if ...</h3>
    </div>
    <div class="span8">
	    <?php echo $form->textFieldRow($model,'description',array('class'=>'input-xlarge', 'maxlength'=>256)); ?>
    </div>
  </div>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
	    'icon'=>'arrow-right white',
			'type'=>'primary',
			'label'=>'Next',
	    //'htmlOptions' => array('class'=>'pull-right',)
		)); ?>
	</div>

<?php $this->endWidget(); ?>
