<?php
/* @var $this ProductvarietyController */
/* @var $data ProductVariety */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('variety_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->variety_id), array('view', 'id'=>$data->variety_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_family_id')); ?>:</b>
	<?php echo CHtml::encode($data->pro_family_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('variety_name')); ?>:</b>
	<?php echo CHtml::encode($data->variety_name); ?>
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

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_by')); ?>:</b>
	<?php echo CHtml::encode($data->modified_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_at')); ?>:</b>
	<?php echo CHtml::encode($data->modified_at); ?>
	<br />

	*/ ?>

</div>