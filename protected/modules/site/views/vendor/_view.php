<?php
/* @var $this VendorController */
/* @var $data Vendor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->vendor_id), array('view', 'id'=>$data->vendor_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_code')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_name')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_address')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_city')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_country')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_country); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_contact_person')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_contact_person); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_mobile_no')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_mobile_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_office_no')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_office_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_email')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_website')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_website); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_trade_mark')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_trade_mark); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_remarks); ?>
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