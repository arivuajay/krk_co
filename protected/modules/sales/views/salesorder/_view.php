<?php
/* @var $this SalesorderController */
/* @var $model Salesorder */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('so_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->so_id), array('view', 'id'=>$data->so_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer')); ?>:</b>
	<?php echo CHtml::encode($data->customer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('primary_contact')); ?>:</b>
	<?php echo CHtml::encode($data->primary_contact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('so_created_date')); ?>:</b>
	<?php echo CHtml::encode($data->so_created_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quote_approved')); ?>:</b>
	<?php echo CHtml::encode($data->quote_approved); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ship_address')); ?>:</b>
	<?php echo CHtml::encode($data->ship_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ship_city')); ?>:</b>
	<?php echo CHtml::encode($data->ship_city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ship_state')); ?>:</b>
	<?php echo CHtml::encode($data->ship_state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('same_as_shipping')); ?>:</b>
	<?php echo CHtml::encode($data->same_as_shipping); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bill_address')); ?>:</b>
	<?php echo CHtml::encode($data->bill_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bill_city')); ?>:</b>
	<?php echo CHtml::encode($data->bill_city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bill_state')); ?>:</b>
	<?php echo CHtml::encode($data->bill_state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->is_deleted); ?>
	<br />

	*/ ?>

</div>