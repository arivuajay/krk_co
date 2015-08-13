<?php
/* @var $this BillladingController */
/* @var $model BillLading */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'bl_id'); ?>
		<?php echo $form->textField($model,'bl_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_company_id'); ?>
		<?php echo $form->textField($model,'bl_company_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_vendor_id'); ?>
		<?php echo $form->textField($model,'bl_vendor_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_po_id'); ?>
		<?php echo $form->textField($model,'bl_po_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_invoice_id'); ?>
		<?php echo $form->textField($model,'bl_invoice_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_number'); ?>
		<?php echo $form->textField($model,'bl_number',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_issue_date'); ?>
		<?php echo $form->textField($model,'bl_issue_date',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_issue_place'); ?>
		<?php echo $form->textField($model,'bl_issue_place',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_load_port'); ?>
		<?php echo $form->textField($model,'bl_load_port',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_discharge_port'); ?>
		<?php echo $form->textField($model,'bl_discharge_port',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_vessal_name'); ?>
		<?php echo $form->textField($model,'bl_vessal_name',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_shipped_date'); ?>
		<?php echo $form->textField($model,'bl_shipped_date',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_container_number'); ?>
		<?php echo $form->textField($model,'bl_container_number',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_liner_id'); ?>
		<?php echo $form->textField($model,'bl_liner_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_container_count'); ?>
		<?php echo $form->textField($model,'bl_container_count',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_free_days'); ?>
		<?php echo $form->textField($model,'bl_free_days',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_frieght_paid'); ?>
		<?php echo $form->textField($model,'bl_frieght_paid',array('class'=>'form-control','size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_documents'); ?>
		<?php echo $form->textArea($model,'bl_documents',array('class'=>'form-control','rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->