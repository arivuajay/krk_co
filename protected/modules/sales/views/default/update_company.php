<?php $this->hiddenpath = "/sales/default/viewcompanies"; ?>
<div class="create_user">
<h1><?php echo $model->name; ?> <?php echo Myclass::t('Company');?></h1>
<?php echo $this->renderPartial('//layouts/_update_company_tabs',array('model'=>$model)); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
)); 
echo $form->errorSummary(array($model),'');
?>

	<p class="note"><?php echo Myclass::t('Fields with');?> <span class="required">*</span> <?php echo Myclass::t('are required');?>.</p>

	

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'customer_type_id'); ?>
		<?php echo $form->dropDownList($model,'customer_type_id', CHtml::listData(Myclass::ActiveCustomerType(), 'customer_type_id', 'customer_type'), array('empty'=>'Select Type')); ?>
		
	</div>
	
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'company_rutno'); ?>
		<?php echo $form->textField($model,'company_rutno',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'staff_size'); ?>
		<?php echo $form->dropDownList($model,'staff_size', Myclass::StaffSize(), array('empty'=>'Select Size')); ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'office_phone'); ?>
		<?php echo $form->textField($model,'office_phone',array('size'=>20,'maxlength'=>20)); ?>
		
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'billing_address'); ?>
		<?php echo $form->textField($model,'billing_address',array('size'=>60,'maxlength'=>100,'placeholder'=>$model->getAttributeLabel('billing_address'))); ?>
		
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'billing_city'); ?>
		<?php echo $form->textField($model,'billing_city',array('size'=>60,'maxlength'=>100,'class'=>'city_autocomplte','autocomplete'=>'off','placeholder'=>$model->getAttributeLabel('billing_city'))); ?>
		
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'billing_state'); ?>
		<?php echo $form->textField($model,'billing_state',array('size'=>20,'maxlength'=>20,'class'=>'state_autocomplte','autocomplete'=>'off','placeholder'=>$model->getAttributeLabel('billing_state'))); ?>
		
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'same_shipping'); ?>
	    <?php echo $form->radioButton($model,'same_shipping',array('value'=>1,'uncheckValue'=>null)).'Yes'; ?>
	    <?php echo $form->radioButton($model,'same_shipping',array('value'=>0,'uncheckValue'=>null)).'No'; ?>

	</div>
	<div id="shipping_addr">
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'shipping_address'); ?>
		<?php echo $form->textField($model,'shipping_address',array('size'=>60,'maxlength'=>100,'placeholder'=>$model->getAttributeLabel('shipping_address'))); ?>
		
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'shipping_city'); ?>
		<?php echo $form->textField($model,'shipping_city',array('size'=>60,'maxlength'=>100,'class'=>'city_autocomplte','autocomplete'=>'off','placeholder'=>$model->getAttributeLabel('shipping_city'))); ?>
		
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'shipping_state'); ?>
		<?php echo $form->textField($model,'shipping_state',array('size'=>20,'maxlength'=>20,'class'=>'state_autocomplte','autocomplete'=>'off','placeholder'=>$model->getAttributeLabel('shipping_state'))); ?>
		
	</div>
	</div>    

	<div class="row-fluid buttons">
		<label>&nbsp;</label>
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>Myclass::t('Submit'))); ?>
	</div>

<?php $this->endWidget(); ?>
<?php
$comuna_lists = array_values(CHtml::listData(Myclass::GetComuna(),'nombre','nombre'));
$region_lists = array_values(CHtml::listData(Myclass::GetRegion(),'nombre','nombre'));

Yii::app()->bootstrap->registerTypeahead('.state_autocomplte', array(
    'source'=> $comuna_lists,
    'items'=>4,
    'matcher'=>"js:function(item) {
        return ~item.toLowerCase().indexOf(this.query.toLowerCase());
    }",
));
Yii::app()->bootstrap->registerTypeahead('.city_autocomplte', array(
    'source'=> $region_lists,
    'items'=>4,
    'matcher'=>"js:function(item) {
        return ~item.toLowerCase().indexOf(this.query.toLowerCase());
    }",
));

?>
</div><!-- form -->
<?php
echo CHtml::script('$(document).ready(function(){
	if($("#Company_same_shipping:checked").val() > 0) $("#shipping_addr").slideUp();
	else $("#shipping_addr").slideDown();

	$("#Company_same_shipping").live("click",function(){
	    if($(this).val() > 0) $("#shipping_addr").slideUp();
	    else $("#shipping_addr").slideDown();
	});
    })');
?>
