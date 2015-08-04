<?php
/* @var $this ProductPriceRangeController */
/* @var $model ProductPriceRange */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-price-range-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'range_from'); ?>
		<?php echo $form->textField($model,'range_from'); ?>
		<?php echo $form->error($model,'range_from'); ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'range_to'); ?>
		<?php echo $form->textField($model,'range_to'); ?>
		<?php echo $form->error($model,'range_to'); ?>
	</div>

	

	<div class="row-fluid buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->