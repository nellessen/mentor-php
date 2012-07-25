<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'login-form',
  'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
	  'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo $form->textFieldRow($model,'email'); ?>
		<?php echo $form->passwordFieldRow($model,'password'); ?>
		<?php echo $form->checkBoxRow($model,'rememberMe'); ?>
		
		
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Login',
		)); ?>


<?php $this->endWidget(); ?>
</div><!-- form -->
