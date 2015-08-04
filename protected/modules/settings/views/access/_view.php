<?php
/* @var $this AccessController */
/* @var $model Access */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('access_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->access_id), array('view', 'id'=>$data->access_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('access_name')); ?>:</b>
	<?php echo CHtml::encode($data->access_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('access_path')); ?>:</b>
	<?php echo CHtml::encode($data->access_path); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:</b>
	<?php echo CHtml::encode($data->modified_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->is_deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderid')); ?>:</b>
	<?php echo CHtml::encode($data->orderid); ?>
	<br />

	*/ ?>

</div>