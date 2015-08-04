<?php
/* @var $this DefaultController */
/* @var $model Updates */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('notify_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->notify_id), array('view', 'id'=>$data->notify_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notify_type')); ?>:</b>
	<?php echo CHtml::encode($data->notify_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notify_update_id')); ?>:</b>
	<?php echo CHtml::encode($data->notify_update_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notify_status')); ?>:</b>
	<?php echo CHtml::encode($data->notify_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notify_from_user')); ?>:</b>
	<?php echo CHtml::encode($data->notify_from_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notify_to_user')); ?>:</b>
	<?php echo CHtml::encode($data->notify_to_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notify_on')); ?>:</b>
	<?php echo CHtml::encode($data->notify_on); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('notify_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->notify_deleted); ?>
	<br />

	*/ ?>

</div>