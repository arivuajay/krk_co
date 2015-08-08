<?php
/* @var $this ProductfamilyController */
/* @var $data ProductFamily */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_family_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pro_family_id), array('view', 'id'=>$data->pro_family_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_family_code')); ?>:</b>
	<?php echo CHtml::encode($data->pro_family_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_family_name')); ?>:</b>
	<?php echo CHtml::encode($data->pro_family_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_by')); ?>:</b>
	<?php echo CHtml::encode($data->modified_by); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_at')); ?>:</b>
	<?php echo CHtml::encode($data->modified_at); ?>
	<br />

	*/ ?>

</div>