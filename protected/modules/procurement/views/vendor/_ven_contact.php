<div class="create_user">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
)); 
echo $form->errorSummary(array($model,$contact),'');
?>

	<div class="row-fluid">
		<?php echo $form->labelEx($contact,'con_name'); ?>
		<?php echo $form->textField($contact,'con_name',array('placeholder'=>$model->getAttributeLabel('con_name'))); ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($contact,'dept_name'); ?>
		<?php echo $form->dropDownList($contact,'dept_name', CHtml::listData(Myclass::ActiveDepartment(), 'depart_id', 'name'), array('empty'=>'Select Department')); ?>
		
	</div>
	<div class="row-fluid">
		<?php echo $form->labelEx($contact,'ven_email'); ?>
		<?php echo $form->textField($contact,'ven_email',array('placeholder'=>$model->getAttributeLabel('ven_email'))); ?>

	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($contact,'job_title'); ?>
		<?php echo $form->textField($contact,'job_title',array('size'=>20,'maxlength'=>20,'placeholder'=>$model->getAttributeLabel('job_title'))); ?>
		
	</div>
	<div class="row-fluid">
		<?php echo $form->labelEx($contact,'is_primary'); ?>
		<?php echo $form->checkbox($contact,'is_primary'); ?>
	</div>
	<div class="row-fluid">
		<?php if(!empty($contact->off_phone)) $off_phone = @explode('-',$contact->off_phone); ?>
		<?php echo $form->labelEx($contact,'off_phone'); ?>
		<?php echo $form->textfield($contact,'off_phone[]',array('maxlength'=>'3','placeholder'=>str_repeat("N",3),'class'=>'mask input-small','value'=>@$off_phone[0])); ?>
		<?php echo $form->textfield($contact,'off_phone[]',array('maxlength'=>'3','placeholder'=>str_repeat("N",3),'class'=>'mask input-small','value'=>@$off_phone[1])); ?>
		<?php echo $form->textfield($contact,'off_phone[]',array('maxlength'=>'3','placeholder'=>str_repeat("N",3),'class'=>'mask input-small','value'=>@$off_phone[2])); ?>	    
	</div>
	<div class="row-fluid">
		<?php echo $form->labelEx($contact,'extn'); ?>
		<?php echo $form->textfield($contact,'extn',array('maxlength'=>'3','placeholder'=>str_repeat("N",3),'class'=>'mask input-small')); ?>	    
	</div>
	<div class="row-fluid">
		<?php if(!empty($contact->mobile)) $mob = @explode('-',$contact->mobile); ?>	    
		<?php echo $form->labelEx($contact,'mobile'); ?>
		<?php echo $form->textfield($contact,'mobile[]',array('maxlength'=>'3','placeholder'=>str_repeat("N",3),'class'=>'mask input-small','value'=>@$mob[0])); ?>
		<?php echo $form->textfield($contact,'mobile[]',array('maxlength'=>'3','placeholder'=>str_repeat("N",3),'class'=>'mask input-small','value'=>@$mob[1])); ?>
		<?php echo $form->textfield($contact,'mobile[]',array('maxlength'=>'3','placeholder'=>str_repeat("N",3),'class'=>'mask input-small','value'=>@$mob[2])); ?>	    
	</div>

	<div class="row-fluid buttons">
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>($contact->isNewRecord)?'Add Contact':'Update Contact')); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Cancel')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php $this->renderPartial('_avail_contacts',  compact('avail_contact')); ?>