<?php
/* @var $this ExpensesController */
/* @var $data Expenses */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->exp_id), array('view', 'id'=>$data->exp_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_name')); ?>:</b>
	<?php echo CHtml::encode($data->exp_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_amount')); ?>:</b>
	<?php echo CHtml::encode($data->exp_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->exp_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_type')); ?>:</b>
	<?php echo CHtml::encode($data->exp_type); ?>
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