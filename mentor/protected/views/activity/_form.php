<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'activity-form',
	'enableAjaxValidation'=>false,
  'type'=>'horizontal',
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model, 'goalId', CHtml::listData(
    $goals, 'id', 'description'),
    array('prompt' => 'Select a Goal')
    ); 
	?>

	<?php echo $form->textFieldRow($model,'description',array('maxlength'=>256)); ?>

	<?php echo $form->textFieldRow($model,'day',array()); ?>

	<?php echo $form->dropDownListRow($model,'status',ZHtml::enumItem($model, 'status')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
