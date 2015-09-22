<?php
/* @var $this ExpenseController */
/* @var $data Expense */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->exp_id), array('view', 'id'=>$data->exp_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->exp_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_subtype_id')); ?>:</b>
	<?php echo CHtml::encode($data->exp_subtype_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_voucher')); ?>:</b>
	<?php echo CHtml::encode($data->exp_voucher); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_pay_mode')); ?>:</b>
	<?php echo CHtml::encode($data->exp_pay_mode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_ref_no')); ?>:</b>
	<?php echo CHtml::encode($data->exp_ref_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_bank_name')); ?>:</b>
	<?php echo CHtml::encode($data->exp_bank_name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_transaction_id')); ?>:</b>
	<?php echo CHtml::encode($data->exp_transaction_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->exp_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_paid_amount')); ?>:</b>
	<?php echo CHtml::encode($data->exp_paid_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_bol_no')); ?>:</b>
	<?php echo CHtml::encode($data->exp_bol_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_invoices')); ?>:</b>
	<?php echo CHtml::encode($data->exp_invoices); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_containers')); ?>:</b>
	<?php echo CHtml::encode($data->exp_containers); ?>
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