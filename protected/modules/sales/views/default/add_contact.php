<?php $this->hiddenpath = "/sales/default/viewcompanies"; ?>
<div class="create_user">
<h1><?php echo $model->name; ?> <?php echo Myclass::t('Company');?></h1>
<?php echo $this->renderPartial('//layouts/_update_company_tabs',array('model'=>$model)); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
)); 
echo $form->errorSummary(array($model,$contact),'');
?>

	<div class="row-fluid">
		<?php echo $form->labelEx($contact,'contact_name'); ?>
		<?php echo $form->textField($contact,'contact_name',array('placeholder'=>$model->getAttributeLabel('contact_name'))); ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($contact,'department_id'); ?>
		<?php echo $form->dropDownList($contact,'department_id', CHtml::listData(Myclass::ActiveDepartment(), 'depart_id', 'name'), array('empty'=>'Select Department')); ?>
		
	</div>
	<div class="row-fluid">
		<?php echo $form->labelEx($contact,'email'); ?>
		<?php echo $form->textField($contact,'email',array('placeholder'=>$model->getAttributeLabel('email'))); ?>

	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($contact,'job_title'); ?>
		<?php echo $form->textField($contact,'job_title',array('size'=>10,'placeholder'=>$model->getAttributeLabel('job_title'))); ?>
		<?php //echo $form->textField($contact,'job_title',array('size'=>20,'maxlength'=>20,'placeholder'=>$model->getAttributeLabel('job_title'))); ?>
		
	</div>
	<div class="row-fluid">
		<?php echo $form->labelEx($contact,'primary_contact'); ?>
		<?php echo $form->checkbox($contact,'primary_contact'); ?>
	</div>
	<div class="row-fluid">
		<?php echo $form->labelEx($contact,'office_phone'); ?>
		<?php echo $form->textfield($contact,'office_phone[]',array('maxlength'=>'3','placeholder'=>str_repeat("N",3),'class'=>'mask input-small')); ?>
		<?php echo $form->textfield($contact,'office_phone[]',array('maxlength'=>'3','placeholder'=>str_repeat("N",3),'class'=>'mask input-small')); ?>
		<?php echo $form->textfield($contact,'office_phone[]',array('placeholder'=>str_repeat("N",3),'class'=>'mask input-small')); ?>	    
		<?php //echo $form->textfield($contact,'office_phone[]',array('maxlength'=>'3','placeholder'=>str_repeat("N",3),'class'=>'mask input-small')); ?>
	</div>
	<div class="row-fluid">
		<?php echo $form->labelEx($contact,'ext'); ?>
		<?php echo $form->textfield($contact,'ext',array('maxlength'=>'3','placeholder'=>str_repeat("N",3),'class'=>'mask input-small')); ?>	    
	</div>
	<div class="row-fluid">
		<?php echo $form->labelEx($contact,'mobile'); ?>
		<?php echo $form->textfield($contact,'mobile[]',array('maxlength'=>'3','placeholder'=>str_repeat("N",3),'class'=>'mask input-small')); ?>
		<?php echo $form->textfield($contact,'mobile[]',array('maxlength'=>'3','placeholder'=>str_repeat("N",3),'class'=>'mask input-small')); ?>
		<?php echo $form->textfield($contact,'mobile[]',array('maxlength'=>'4','placeholder'=>str_repeat("N",4),'class'=>'mask input-small')); ?>
	</div>

	<div class="row-fluid buttons">
		<label>&nbsp;</label>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>Myclass::t('Add Contact'))); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>Myclass::t('Cancel'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php $this->renderPartial('_avail_contacts',  compact('avail_contact')); ?>