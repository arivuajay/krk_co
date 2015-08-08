<?php
/* @var $this LinerController */
/* @var $data Liner */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('liner_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->liner_id), array('view', 'id'=>$data->liner_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('liner_name')); ?>:</b>
	<?php echo CHtml::encode($data->liner_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_id')); ?>:</b>
	<?php echo CHtml::encode($data->country_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_of_free_days')); ?>:</b>
	<?php echo CHtml::encode($data->no_of_free_days); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_at')); ?>:</b>
	<?php echo CHtml::encode($data->modified_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_by')); ?>:</b>
	<?php echo CHtml::encode($data->modified_by); ?>
	<br />

	*/ ?>

</div>