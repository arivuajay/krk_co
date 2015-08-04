<?php
$this->hiddenpath = "/settings/sitesettings/index";
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sitesettings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Myclass::t('Fields with');?> <span class="required">*</span> <?php echo Myclass::t('are required');?>.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'param_key'); ?>
		<?php echo $form->textField($model,'param_key',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'param_key'); ?>
	</div>
	<div id="param_vaules">
	    <div class="row-fluid">
		    <?php echo $form->labelEx($model,'param_value'); ?>
		    <?php echo $form->textField($model,'param_value'); ?>
		    <?php echo $form->error($model,'param_value'); ?>
		    <?php // echo CHtml::link('ADD','javacript:void(0);',array('class'=>'add_new_row')); ?>
	    </div>
	</div>
	
	

	<div class="row-fluid buttons">
	    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>$model->isNewRecord ? Myclass::t('Create') : Myclass::t('Save'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div>