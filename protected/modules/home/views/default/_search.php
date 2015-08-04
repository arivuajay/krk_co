<?php
/* @var $this DefaultController */
/* @var $model Updates */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'notify_id'); ?>
		<?php echo $form->textField($model,'notify_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notify_type'); ?>
		<?php echo $form->textField($model,'notify_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notify_update_id'); ?>
		<?php echo $form->textArea($model,'notify_update_id',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notify_status'); ?>
		<?php echo $form->textField($model,'notify_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notify_from_user'); ?>
		<?php echo $form->textField($model,'notify_from_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notify_to_user'); ?>
		<?php echo $form->textField($model,'notify_to_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notify_on'); ?>
		<?php echo $form->textField($model,'notify_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notify_deleted'); ?>
		<?php echo $form->textField($model,'notify_deleted',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->