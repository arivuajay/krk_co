<?php
$this->hiddenpath = '/settings/role/index';
?>
<div class="create_user">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'role-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Myclass::t('Fields with');?> <span class="required">*</span> <?php echo Myclass::t('are required');?>.</p>
	
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name',array('style'=>'padding-left:170px;')); ?>
	</div>

	<div class="row-fluid buttons">
	    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>$model->isNewRecord ? Myclass::t('Create') : Myclass::t('Save'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>