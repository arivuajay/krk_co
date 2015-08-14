<?php
/* @var $this PytooriginController */
/* @var $data PytoOrigin */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pyto_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pyto_id), array('view', 'id'=>$data->pyto_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pyto_company_id')); ?>:</b>
	<?php echo CHtml::encode($data->pyto_company_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pyto_vendor_id')); ?>:</b>
	<?php echo CHtml::encode($data->pyto_vendor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pyto_po_id')); ?>:</b>
	<?php echo CHtml::encode($data->pyto_po_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pyto_invoice_id')); ?>:</b>
	<?php echo CHtml::encode($data->pyto_invoice_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pyto_cert_no')); ?>:</b>
	<?php echo CHtml::encode($data->pyto_cert_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doinspection')); ?>:</b>
	<?php echo CHtml::encode($data->doinspection); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('origin_cert_no')); ?>:</b>
	<?php echo CHtml::encode($data->origin_cert_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pyto_file')); ?>:</b>
	<?php echo CHtml::encode($data->pyto_file); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('origin_file')); ?>:</b>
	<?php echo CHtml::encode($data->origin_file); ?>
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