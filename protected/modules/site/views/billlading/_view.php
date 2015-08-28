<?php
/* @var $this BillladingController */
/* @var $data BillLading */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->bl_id), array('view', 'id'=>$data->bl_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_company_id')); ?>:</b>
	<?php echo CHtml::encode($data->bl_company_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_vendor_id')); ?>:</b>
	<?php echo CHtml::encode($data->bl_vendor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_po_id')); ?>:</b>
	<?php echo CHtml::encode($data->bl_po_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_invoice_id')); ?>:</b>
	<?php echo CHtml::encode($data->bl_invoice_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_number')); ?>:</b>
	<?php echo CHtml::encode($data->bl_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_issue_date')); ?>:</b>
	<?php echo CHtml::encode($data->bl_issue_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_issue_place')); ?>:</b>
	<?php echo CHtml::encode($data->bl_issue_place); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_load_port')); ?>:</b>
	<?php echo CHtml::encode($data->bl_load_port); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_discharge_port')); ?>:</b>
	<?php echo CHtml::encode($data->bl_discharge_port); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_vessal_name')); ?>:</b>
	<?php echo CHtml::encode($data->bl_vessal_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_shipped_date')); ?>:</b>
	<?php echo CHtml::encode($data->bl_shipped_date); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_liner_id')); ?>:</b>
	<?php echo CHtml::encode($data->bl_liner_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_container_count')); ?>:</b>
	<?php echo CHtml::encode($data->bl_container_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_free_days')); ?>:</b>
	<?php echo CHtml::encode($data->bl_free_days); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_frieght_paid')); ?>:</b>
	<?php echo CHtml::encode($data->bl_frieght_paid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_documents')); ?>:</b>
	<?php echo CHtml::encode($data->bl_documents); ?>
	<br />

	*/ ?>

</div>