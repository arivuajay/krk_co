<?php
/* @var $this DefaultController */
/* @var $model Updates */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'updates-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'notify_type'); ?>
		<?php echo $form->textField($model,'notify_type'); ?>
		<?php echo $form->error($model,'notify_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notify_update_id'); ?>
		<?php echo $form->textArea($model,'notify_update_id',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notify_update_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notify_status'); ?>
		<?php echo $form->textField($model,'notify_status'); ?>
		<?php echo $form->error($model,'notify_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notify_from_user'); ?>
		<?php echo $form->textField($model,'notify_from_user'); ?>
		<?php echo $form->error($model,'notify_from_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notify_to_user'); ?>
		<?php echo $form->textField($model,'notify_to_user'); ?>
		<?php echo $form->error($model,'notify_to_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notify_on'); ?>
		<?php echo $form->textField($model,'notify_on'); ?>
		<?php echo $form->error($model,'notify_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notify_deleted'); ?>
		<?php echo $form->textField($model,'notify_deleted',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'notify_deleted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->