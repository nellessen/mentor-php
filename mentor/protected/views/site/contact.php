<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>
<div class="page-header">
  <h1>Contact Us</h1>
</div>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>Please fill out the following form to contact us. Thank you.</p>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
  'type'=>'horizontal',
)); ?>

	<?php echo $form->errorSummary($model); ?>

  <?php echo $form->textFieldRow($model,'name',array()); ?>
  <?php echo $form->textFieldRow($model,'email',array()); ?>
  <?php echo $form->textFieldRow($model,'subject',array()); ?>
  <?php echo $form->textAreaRow($model,'body',array('rows'=>6, 'cols'=>50)); ?>

	<?php if(CCaptcha::checkRequirements()): ?>
    <?php echo $form->captchaRow($model,'verifyCode',array()); ?>
	<?php endif; ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Submit',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>