<?php
/* @var $this SalesexpensesController */
/* @var $data SalesExpenses */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_exp_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sale_exp_id), array('view', 'id'=>$data->sale_exp_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_exp_date')); ?>:</b>
	<?php echo CHtml::encode($data->sale_exp_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_exp_amount')); ?>:</b>
	<?php echo CHtml::encode($data->sale_exp_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_exp_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->sale_exp_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sales_exp_cust_name')); ?>:</b>
	<?php echo CHtml::encode($data->sales_exp_cust_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sales_exp_address')); ?>:</b>
	<?php echo CHtml::encode($data->sales_exp_address); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_at')); ?>:</b>
	<?php echo CHtml::encode($data->modified_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_by')); ?>:</b>
	<?php echo CHtml::encode($data->modified_by); ?>
	<br />

	*/ ?>

</div>