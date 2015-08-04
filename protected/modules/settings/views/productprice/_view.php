<?php
/* @var $this ProductPriceRangeController */
/* @var $model ProductPriceRange */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('prid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->prid), array('view', 'id'=>$data->prid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('range_from')); ?>:</b>
	<?php echo CHtml::encode($data->range_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('range_to')); ?>:</b>
	<?php echo CHtml::encode($data->range_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_by')); ?>:</b>
	<?php echo CHtml::encode($data->modified_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->is_deleted); ?>
	<br />


</div>