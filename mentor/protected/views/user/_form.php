<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
  'type'=>'horizontal',
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'email',array('maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'firstname',array('maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'lastname',array('maxlength'=>128)); ?>

	<?php echo $form->dropDownListRow($model,'gender',ZHtml::enumItem($model, 'gender')); ?>

	<?php echo $form->passwordFieldRow($model,'password',array('maxlength'=>128)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
