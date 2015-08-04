<?php
/* @var $this OrderdetailController */
/* @var $model Orderdetail */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orderdetail-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Myclass::t('Fields with');?> <span class="required">*</span> <?php echo Myclass::t('are required');?>.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'order_date'); ?>
		<?php echo $form->textField($model,'order_date',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'order_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shipment_date'); ?>
		<?php echo $form->textField($model,'shipment_date',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'shipment_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_name'); ?>
		<?php echo $form->textField($model,'product_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'product_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
		<?php echo $form->error($model,'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unit_price'); ?>
		<?php echo $form->textField($model,'unit_price'); ?>
		<?php echo $form->error($model,'unit_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order_value'); ?>
		<?php echo $form->textField($model,'order_value'); ?>
		<?php echo $form->error($model,'order_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_order_value'); ?>
		<?php echo $form->textField($model,'total_order_value'); ?>
		<?php echo $form->error($model,'total_order_value'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Myclass::t('Create') : Myclass::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->