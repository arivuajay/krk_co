<?php
/* @var $this PermitController */
/* @var $model Permit */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'permit_id'); ?>
		<?php echo $form->textField($model,'permit_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'permit_no'); ?>
		<?php echo $form->textField($model,'permit_no',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doissue'); ?>
		<?php echo $form->textField($model,'doissue',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valupto'); ?>
		<?php echo $form->textField($model,'valupto',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'permit_regno'); ?>
		<?php echo $form->textField($model,'permit_regno',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'permit_poissue'); ?>
		<?php echo $form->textField($model,'permit_poissue',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'permit_file'); ?>
		<?php echo $form->textField($model,'permit_file',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
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