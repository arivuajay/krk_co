<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);
?>
<h1>Create User</h1>
<div class="create_user">
<div class="form">

    
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); 
//echo '<pre>';
//print_r(CHtml::listData(Myclass::getAccessByRole(array('1')), 'access_id', 'access.access_path')); 
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($model,$profmodel,$Userrolemodel),''); ?>
	
	<div class="row-fluid">
		<?php echo $form->labelEx($profmodel,'title',array('class'=>'input-small')); ?>
		<?php echo $form->dropDownList($profmodel,'title',Myclass::MemberTitles(),array('class'=>'input-small')); ?>
		<?php echo $form->textField($profmodel,'first_name',array('class'=>'input-small','placeholder'=>$profmodel->getAttributeLabel('first_name'))); ?>
		<?php echo $form->textField($profmodel,'last_name',array('class'=>'input-small','placeholder'=>$profmodel->getAttributeLabel('last_name'))); ?>
	</div>
	
	<div class="row-fluid">
		<?php echo $form->labelEx($Userrolemodel,'role_id'); ?>
		<?php echo $form->dropDownList($Userrolemodel,'role_id', CHtml::listData(Myclass::ActiveRoles(), 'role_id', 'name'), array('empty'=>'Select Role','multiple'=>'multiple')); ?>
	</div>
	
	<div class="row-fluid">
		<?php echo $form->labelEx($Userreportingmodel,'reporting_user_id'); ?>
		<?php echo $form->dropDownList($Userreportingmodel,'reporting_user_id', CHtml::listData(Myclass::GetUserByRoles(), 'user_role_id', 'fullname'), array('empty'=>'Choose Reporter','multiple'=>'multiple')); ?>
	</div>
	
	<div class="row-fluid">
		<?php echo $form->labelEx($profmodel,'email_address'); ?>
		<?php echo $form->textField($profmodel,'email_address',array('size'=>55,'maxlength'=>500)); ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>55,'maxlength'=>500)); ?>
	</div>
	
	<div class="row-fluid">
		<?php echo $form->labelEx($profmodel,'phone'); ?>
		<?php echo $form->textField($profmodel,'phone',array('size'=>55,'maxlength'=>500)); ?>
	</div>
	
	<div class="row-fluid">
		<?php echo $form->labelEx($profmodel,'mobile'); ?>
		<?php echo $form->textField($profmodel,'mobile',array('size'=>55,'maxlength'=>500)); ?>
	</div>
	
	<div class="row-fluid">
		<?php echo $form->labelEx($profmodel,'address'); ?>
		<?php echo $form->textField($profmodel,'address',array('size'=>55,'maxlength'=>500)); ?>
	</div>

	<div class="row-fluid">
		<label>&nbsp;</label>
	    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit')); ?>
	    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div><!-- Create user -->