<?php
/* @var $this PytooriginController */
/* @var $model PytoOrigin */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pyto_id'); ?>
		<?php echo $form->textField($model,'pyto_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pyto_company_id'); ?>
		<?php echo $form->textField($model,'pyto_company_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pyto_vendor_id'); ?>
		<?php echo $form->textField($model,'pyto_vendor_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pyto_po_id'); ?>
		<?php echo $form->textField($model,'pyto_po_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pyto_invoice_id'); ?>
		<?php echo $form->textField($model,'pyto_invoice_id',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pyto_cert_no'); ?>
		<?php echo $form->textField($model,'pyto_cert_no',array('class'=>'form-control','size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doinspection'); ?>
		<?php echo $form->textField($model,'doinspection',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'origin_cert_no'); ?>
		<?php echo $form->textField($model,'origin_cert_no',array('class'=>'form-control','size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pyto_file'); ?>
		<?php echo $form->textField($model,'pyto_file',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'origin_file'); ?>
		<?php echo $form->textField($model,'origin_file',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('class'=>'form-control')); ?>
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