<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
  'type'=>'horizontal',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array()); ?>

	<?php echo $form->textFieldRow($model,'userId',array()); ?>

	<?php echo $form->textFieldRow($model,'mentor1_email',array('maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'mentor1_name',array('maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'mentor2_email',array('maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'mentor2_name',array('maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'mentor3_email',array('maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'mentor3_name',array('maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'description',array('maxlength'=>256)); ?>

	<?php echo $form->textFieldRow($model,'active',array()); ?>

	<?php echo $form->textFieldRow($model,'created',array()); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
