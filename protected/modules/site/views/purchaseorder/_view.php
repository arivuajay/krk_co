<?php
/* @var $this PurchaseorderController */
/* @var $data PurchaseOrder */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('po_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->po_id), array('view', 'id'=>$data->po_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('po_number')); ?>:</b>
	<?php echo CHtml::encode($data->po_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('po_date')); ?>:</b>
	<?php echo CHtml::encode($data->po_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('po_company_id')); ?>:</b>
	<?php echo CHtml::encode($data->po_company_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('po_vendor_id')); ?>:</b>
	<?php echo CHtml::encode($data->po_vendor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<?php /*
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