<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userId')); ?>:</b>
	<?php echo CHtml::encode($data->userId); ?>
	<br />
	
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<?php /*

	<b><?php echo CHtml::encode($data->getAttributeLabel('mentor1_email')); ?>:</b>
	<?php echo CHtml::encode($data->mentor1_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mentor1_name')); ?>:</b>
	<?php echo CHtml::encode($data->mentor1_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mentor2_email')); ?>:</b>
	<?php echo CHtml::encode($data->mentor2_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mentor2_name')); ?>:</b>
	<?php echo CHtml::encode($data->mentor2_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mentor3_email')); ?>:</b>
	<?php echo CHtml::encode($data->mentor3_email); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('mentor3_name')); ?>:</b>
	<?php echo CHtml::encode($data->mentor3_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	*/ ?>

</div>

<hr>