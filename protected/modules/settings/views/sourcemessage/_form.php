<?php
/* @var $this SourcemessageController */
/* @var $model Sourcemessage */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sourcemessage-form',
	'enableAjaxValidation'=>false,
)); 
echo $form->errorSummary(array($model,$msgmodel),'');
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->dropDownList($model,'category', CHtml::listData(Myclass::GetApplicationmodules(), 'name', 'name' )); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textField($model,'message',array('size'=>60)); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($msgmodel,'translation'); ?>
		<?php echo $form->textArea($msgmodel,'translation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($msgmodel,'translation'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->