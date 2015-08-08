<?php
/* @var $this PermitController */
/* @var $data Permit */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('permit_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->permit_id), array('view', 'id'=>$data->permit_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_id')); ?>:</b>
	<?php echo CHtml::encode($data->company_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permit_no')); ?>:</b>
	<?php echo CHtml::encode($data->permit_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doissue')); ?>:</b>
	<?php echo CHtml::encode($data->doissue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valupto')); ?>:</b>
	<?php echo CHtml::encode($data->valupto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permit_regno')); ?>:</b>
	<?php echo CHtml::encode($data->permit_regno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permit_poissue')); ?>:</b>
	<?php echo CHtml::encode($data->permit_poissue); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('permit_file')); ?>:</b>
	<?php echo CHtml::encode($data->permit_file); ?>
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