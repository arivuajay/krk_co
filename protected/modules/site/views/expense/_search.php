<?php
/* @var $this ExpenseController */
/* @var $model Expense */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'exp_id'); ?>
		<?php echo $form->textField($model,'exp_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exp_type_id'); ?>
		<?php echo $form->textField($model,'exp_type_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exp_subtype_id'); ?>
		<?php echo $form->textField($model,'exp_subtype_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exp_voucher'); ?>
		<?php echo $form->textField($model,'exp_voucher',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exp_pay_mode'); ?>
		<?php echo $form->textField($model,'exp_pay_mode',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exp_ref_no'); ?>
		<?php echo $form->textField($model,'exp_ref_no',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exp_bank_name'); ?>
		<?php echo $form->textField($model,'exp_bank_name',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exp_transaction_id'); ?>
		<?php echo $form->textField($model,'exp_transaction_id',array('class'=>'form-control','size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exp_remarks'); ?>
		<?php echo $form->textArea($model,'exp_remarks',array('class'=>'form-control','rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exp_paid_amount'); ?>
		<?php echo $form->textField($model,'exp_paid_amount',array('class'=>'form-control','size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exp_bol_no'); ?>
		<?php echo $form->textField($model,'exp_bol_no',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exp_invoices'); ?>
		<?php echo $form->textField($model,'exp_invoices',array('class'=>'form-control','size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exp_containers'); ?>
		<?php echo $form->textField($model,'exp_containers',array('class'=>'form-control','size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('class'=>'form-control','size'=>1,'maxlength'=>1)); ?>
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