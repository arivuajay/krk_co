<div class="create_user">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vendor-form',
	'enableAjaxValidation'=>false,
)); 
echo $form->errorSummary(array($model),'');
?>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'ven_name'); ?>
		<?php echo $form->textField($model,'ven_name',array('size'=>60,'maxlength'=>200)); ?>
		
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'ven_type'); ?>
		<?php echo $form->dropDownList($model,'ven_type', CHtml::listData(Myclass::ActiveCustomerType(), 'customer_type_id', 'customer_type'), array('empty'=>'Select Type')); ?>
		
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'ven_size'); ?>
		<?php echo $form->dropDownList($model,'ven_size', Myclass::StaffSize(), array('empty'=>'Select Size')); ?>
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'off_phone'); ?>
		<?php echo $form->textField($model,'off_phone',array('size'=>20,'maxlength'=>20)); ?>
		
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'bill_addr'); ?>
		<?php echo $form->textField($model,'bill_addr',array('size'=>60,'maxlength'=>100,'placeholder'=>$model->getAttributeLabel('bill_addr'))); ?>
		
	</div>

	<div class="row-fluid">
		<label>&nbsp;</label>
		<?php echo $form->textField($model,'bill_city',array('size'=>60,'maxlength'=>100,'class'=>'city_autocomplte','autocomplete'=>'off','placeholder'=>$model->getAttributeLabel('bill_city'))); ?>
		
	</div>

	<div class="row-fluid">
		<label>&nbsp;</label>
		<?php echo $form->textField($model,'bill_state',array('size'=>20,'maxlength'=>20,'class'=>'state_autocomplte','autocomplete'=>'off','placeholder'=>$model->getAttributeLabel('bill_state'))); ?>
		
	</div>

	<div class="row-fluid">
	    <?php echo $form->labelEx($model,'same_shipping'); ?>
	    <?php echo $form->radioButton($model,'same_shipping',array('value'=>1,'uncheckValue'=>null)).'Yes'; ?>
	    <?php echo $form->radioButton($model,'same_shipping',array('value'=>0,'uncheckValue'=>null)).'No'; ?>

	</div>
	<div id="shipping_addr">
	<div class="row-fluid">
		<?php echo $form->labelEx($model,'ship_addr'); ?>
		<?php echo $form->textField($model,'ship_addr',array('size'=>60,'maxlength'=>100,'placeholder'=>$model->getAttributeLabel('ship_addr'))); ?>
		
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'ship_city'); ?>
		<?php echo $form->textField($model,'ship_city',array('size'=>60,'maxlength'=>100,'class'=>'city_autocomplte','autocomplete'=>'off','placeholder'=>$model->getAttributeLabel('ship_city'))); ?>
		
	</div>

	<div class="row-fluid">
		<?php echo $form->labelEx($model,'ship_state'); ?>
		<?php echo $form->textField($model,'ship_state',array('size'=>20,'maxlength'=>20,'class'=>'state_autocomplte','autocomplete'=>'off','placeholder'=>$model->getAttributeLabel('ship_state'))); ?>
		
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
	if($("#Vendor_same_shipping:checked").val() > 0) $("#shipping_addr").slideUp();
	else $("#shipping_addr").slideDown();

	$("#Vendor_same_shipping").live("click",function(){
	    if($(this).val() > 0) $("#shipping_addr").slideUp();
	    else $("#shipping_addr").slideDown();
	});
    })');
?>
