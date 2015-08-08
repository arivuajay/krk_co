<?php
/* @var $this ProductfamilyController */
/* @var $model ProductFamily */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pro_family_id'); ?>
		<?php echo $form->textField($model,'pro_family_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_family_code'); ?>
		<?php echo $form->textField($model,'pro_family_code',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_family_name'); ?>
		<?php echo $form->textField($model,'pro_family_name',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('class'=>'form-control','size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified_by'); ?>
		<?php echo $form->textField($model,'modified_by',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified_at'); ?>
		<?php echo $form->textField($model,'modified_at',array('class'=>'form-control')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->