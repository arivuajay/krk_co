<?php
/* @var $this InvoiceController */
/* @var $data Invoice */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->invoice_id), array('view', 'id'=>$data->invoice_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_id')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_id')); ?>:</b>
	<?php echo CHtml::encode($data->company_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('po_id')); ?>:</b>
	<?php echo CHtml::encode($data->po_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permit_no')); ?>:</b>
	<?php echo CHtml::encode($data->permit_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bol_no')); ?>:</b>
	<?php echo CHtml::encode($data->bol_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inv_no')); ?>:</b>
	<?php echo CHtml::encode($data->inv_no); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('vessel_name')); ?>:</b>
	<?php echo CHtml::encode($data->vessel_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inv_date')); ?>:</b>
	<?php echo CHtml::encode($data->inv_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inv_file')); ?>:</b>
	<?php echo CHtml::encode($data->inv_file); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pkg_list_file')); ?>:</b>
	<?php echo CHtml::encode($data->pkg_list_file); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_at')); ?>:</b>
	<?php echo CHtml::encode($data->modified_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_by')); ?>:</b>
	<?php echo CHtml::encode($data->modified_by); ?>
	<br />

	*/ ?>

</div>