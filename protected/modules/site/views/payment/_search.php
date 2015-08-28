<?php
/* @var $this PaymentController */
/* @var $model Payment */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pay_id'); ?>
		<?php echo $form->textField($model,'pay_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vendor_id'); ?>
		<?php echo $form->textField($model,'vendor_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_type'); ?>
		<?php echo $form->textField($model,'pay_type',array('class'=>'form-control','size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'po_id'); ?>
		<?php echo $form->textField($model,'po_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_id'); ?>
		<?php echo $form->textField($model,'invoice_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_amount'); ?>
		<?php echo $form->textField($model,'invoice_amount',array('class'=>'form-control','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_amount'); ?>
		<?php echo $form->textField($model,'pay_amount',array('class'=>'form-control','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_deal_id'); ?>
		<?php echo $form->textField($model,'pay_deal_id',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_inr_rate'); ?>
		<?php echo $form->textField($model,'pay_inr_rate',array('class'=>'form-control','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_date'); ?>
		<?php echo $form->textField($model,'pay_date',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_inr_amount'); ?>
		<?php echo $form->textField($model,'pay_inr_amount',array('class'=>'form-control','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_mode'); ?>
		<?php echo $form->textField($model,'pay_mode',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_ref_info'); ?>
		<?php echo $form->textField($model,'pay_ref_info',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_transaction_id'); ?>
		<?php echo $form->textField($model,'pay_transaction_id',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_bank_name'); ?>
		<?php echo $form->textField($model,'pay_bank_name',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_remarks'); ?>
		<?php echo $form->textArea($model,'pay_remarks',array('class'=>'form-control','rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_shift_advise'); ?>
		<?php echo $form->textField($model,'pay_shift_advise',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_debit_advise'); ?>
		<?php echo $form->textField($model,'pay_debit_advise',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_other_doc'); ?>
		<?php echo $form->textField($model,'pay_other_doc',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_deal_id_copy'); ?>
		<?php echo $form->textField($model,'pay_deal_id_copy',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified_at'); ?>
		<?php echo $form->textField($model,'modified_at',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified_by'); ?>
		<?php echo $form->textField($model,'modified_by',array('class'=>'form-control')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->