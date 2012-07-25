<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'goal-form',
	'enableAjaxValidation'=>false,
  'type'=>'horizontal',
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'mentor1_email',array('maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'mentor1_name',array('maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'mentor2_email',array('maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'mentor2_name',array('maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'mentor3_email',array('maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'mentor3_name',array('maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'description',array('maxlength'=>256)); ?>

	<?php echo $form->checkBoxRow($model,'active',array()); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
