<?php
/* @var $this PaymentController */
/* @var $data Payment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pay_id), array('view', 'id'=>$data->pay_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_id')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_type')); ?>:</b>
	<?php echo CHtml::encode($data->pay_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('po_id')); ?>:</b>
	<?php echo CHtml::encode($data->po_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_id')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_amount')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_amount')); ?>:</b>
	<?php echo CHtml::encode($data->pay_amount); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_deal_id')); ?>:</b>
	<?php echo CHtml::encode($data->pay_deal_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_inr_rate')); ?>:</b>
	<?php echo CHtml::encode($data->pay_inr_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_date')); ?>:</b>
	<?php echo CHtml::encode($data->pay_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_inr_amount')); ?>:</b>
	<?php echo CHtml::encode($data->pay_inr_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_mode')); ?>:</b>
	<?php echo CHtml::encode($data->pay_mode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_ref_info')); ?>:</b>
	<?php echo CHtml::encode($data->pay_ref_info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_transaction_id')); ?>:</b>
	<?php echo CHtml::encode($data->pay_transaction_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_bank_name')); ?>:</b>
	<?php echo CHtml::encode($data->pay_bank_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->pay_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_shift_advise')); ?>:</b>
	<?php echo CHtml::encode($data->pay_shift_advise); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_debit_advise')); ?>:</b>
	<?php echo CHtml::encode($data->pay_debit_advise); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_other_doc')); ?>:</b>
	<?php echo CHtml::encode($data->pay_other_doc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_deal_id_copy')); ?>:</b>
	<?php echo CHtml::encode($data->pay_deal_id_copy); ?>
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