<?php
$this->hiddenpath = '/products/category/index';
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Myclass::t('Fields with');?> <span class="required">*</span> <?php echo Myclass::t('are required');?>.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo $form->dropDownList($model,'parent_id',Myclass::getParentCategory(),array('options' => array($pid=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>
	
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	

	<div class="row-fluid buttons">
		<label>&nbsp;</label>
		<?php echo CHtml::submitButton($model->isNewRecord ? Myclass::t('Create') : Myclass::t('Update')); ?>
		<?php echo CHtml::button(Myclass::t("Cancel"),array("onclick"=>"window.location='".Yii::app()->getBaseUrl(true)."/products/category/index'")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->