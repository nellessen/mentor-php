<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array()); ?>

	<?php echo $form->textFieldRow($model,'userId',array()); ?>

	<?php echo $form->textFieldRow($model,'goalId',array()); ?>

	<?php echo $form->textFieldRow($model,'description',array('maxlength'=>256)); ?>

	<?php echo $form->textFieldRow($model,'day',array()); ?>

	<?php echo $form->textFieldRow($model,'status',array('maxlength'=>10)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
