<?php
/* @var $this OrderdetailController */
/* @var $model Orderdetail */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('od_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->od_id), array('view', 'id'=>$data->od_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_date')); ?>:</b>
	<?php echo CHtml::encode($data->order_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipment_date')); ?>:</b>
	<?php echo CHtml::encode($data->shipment_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_name')); ?>:</b>
	<?php echo CHtml::encode($data->product_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit_price')); ?>:</b>
	<?php echo CHtml::encode($data->unit_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_value')); ?>:</b>
	<?php echo CHtml::encode($data->order_value); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('total_order_value')); ?>:</b>
	<?php echo CHtml::encode($data->total_order_value); ?>
	<br />

	*/ ?>

</div>