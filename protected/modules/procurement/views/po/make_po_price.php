<?php 
$this->hiddenpath = '/procurement/po/create'; 
if(empty($model)):
    Yii::app()->user->setFlash('error',Myclass::t('Session Expired. Create Request Again'));
    CController::redirect(array('/procurement/po/create'));
endif;
?>
<h1><?php echo Myclass::t('Create PO Requests');?></h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'makepo-form',
	'enableAjaxValidation'=>false,
)); 
echo $form->errorSummary(array($po),''); 
//echo '<pre>';print_r($products);
//echo '<pre>';print_r($model); exit;
$prod_error = false;

foreach($model as $key => $poprod):
    if($poprod->hasErrors()) $prod_error = true;
//    var_dump($prod_detail['prod_id']);
?>
<div class="row-fluid po_prod_list">
    <?php 
    $discount_range = Myclass::getDiscountsRange();
//    var_dump($poprod->product); exit;
    if($poprod->prod_scenario == 'product'):
	echo $poprod->product->name;	
    else:
	echo $poprod->item->name;		
    endif;

    $deafult_unit_price = $poprod->vendor_assigned_price;
    $deafult_item_value = $deafult_unit_price * $poprod->quantity;
    $deafult_net_cost	= $deafult_item_value * ((100-$poprod->discounts) / 100);

    echo $form->textField($poprod,"[{$key}]quantity",array('class'=>'input-mini'));
    echo $form->textField($poprod,"[{$key}]vendor_unit_price",array('placeholder'=>$poprod->getAttributeLabel('vendor_unit_price'),'class'=>'input-small','onkeypress'=>'return isNumberKey(event)','value'=>$deafult_unit_price)); 
    echo $form->textField($poprod,"[{$key}]item_value",array('placeholder'=>$poprod->getAttributeLabel('item_value'),'class'=>'input-small','data-name'=>'item_value','onkeypress'=>'return isNumberKey(event)','value'=>$deafult_item_value)); 
    echo $form->dropdownList($poprod,"[{$key}]discounts",$discount_range,array('placeholder'=>$poprod->getAttributeLabel('discounts'),'class'=>'input-small','data-name'=>'discount_change')); 
    echo $form->textField($poprod,"[{$key}]net_cost",array('placeholder'=>$poprod->getAttributeLabel('net_cost'),'class'=>'input-small','onkeypress'=>'return isNumberKey(event)','value'=>$deafult_net_cost,'data-name'=>'net_cost')); 
    
    echo $form->hiddenField($poprod,"[{$key}]prod_id",array('placeholder'=>$poprod->getAttributeLabel('prod_id'),'class'=>'input-small','value'=>$poprod->prod_scenario."_".$poprod->prod_id));
    echo $form->hiddenField($poprod,"[{$key}]vendor_assigned_price",array('placeholder'=>$poprod->getAttributeLabel('vendor_assigned_price'),'class'=>'input-small'));     
    ?>
</div>	
<?php endforeach; ?>
<?php 	echo '<label>Total Value : '.Myclass::GetSiteSetting('AMOUNT_FORMAT').'<span id="total_value"></span></label>'; ?>    
    <div class="make_quote_button">
    <?php
	echo $form->labelEx($po,'po_delivery_date',array('class'=>'ex_del'));
	$this->getDatePicker('po_delivery_date', $po,'');
	
	echo CHtml::submitButton(Myclass::t('Create PO Request'),array('class'=>'quote_sub'));
//	$this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Create PO Request'));
    ?>
    </div>
    <?PHP
    if(@$this->action->id != 'edit')
        echo CHtml::link(Myclass::t('Add More Products'),array('/procurement/po/create','venid'=>$venid),array('class'=>'add_more_prdts'));
    ?>
<?php $this->endWidget(); ?>
</div><!-- form -->
<?php
if($prod_error):
    echo CHtml::script("$(document).ready(function(){
	if($('div').hasClass('alert-error'))
	{
	    $('div.alert-error').find('ul').append('<li>Fill all the fields</li>');
	}
	else
	{
	$('form').prepend('<div class=\'alert alert-error fade in\'><ul><li>Fill all the fields</li></ul></div>');
	}
    });");
//$deafult_net_cost	= $deafult_item_value * ((100-$poprod->discounts) / 100);
endif;
echo CHtml::script("$(document).ready(function(){
	total_value_calc();

	$('select[data-name=\'discount_change\']').live('change',function(){
	   var list = $(this).closest('div.po_prod_list');
	   var item_value = list.find('input[data-name=\'item_value\']').val();
	   var discount = $(this).val();
	   var net_cost	= item_value * ((100-discount) / 100);
	   
	   list.find('input[data-name=\'net_cost\']').val(net_cost);
	   total_value_calc();
	});
});
function total_value_calc()
{
var total_value = 0;
    $('#makepo-form input[data-name=\'net_cost\']').each(function(){
	total_value += parseFloat($(this).val(),2);
    });
    $('span#total_value').html(total_value);
}
");
?>

