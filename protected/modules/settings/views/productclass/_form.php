<?php
/* @var $this ProductClassController */
/* @var $model ProductClass */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-class-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Myclass::t('Fields with');?> <span class="required">*</span> <?php echo Myclass::t('are required');?>.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	

	<div class="row-fluid buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Myclass::t('Create') : Myclass::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->