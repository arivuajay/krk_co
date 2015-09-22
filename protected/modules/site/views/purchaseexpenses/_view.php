<?php
/* @var $this PurchaseexpensesController */
/* @var $data PurchaseExpenses */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pur_exp_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pur_exp_id), array('view', 'id'=>$data->pur_exp_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('po_id')); ?>:</b>
	<?php echo CHtml::encode($data->po_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pur_exp_date')); ?>:</b>
	<?php echo CHtml::encode($data->pur_exp_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pur_exp_amount')); ?>:</b>
	<?php echo CHtml::encode($data->pur_exp_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pur_exp_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->pur_exp_remarks); ?>
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