<h1>
<?php 
if(@$this->action->id == 'edit')://Edit Mode 
    echo Yii::t("sales",'EDIT_QUOTE',array('{QUOTE_ID}'=>$quote->quote_id));
else:
    echo Yii::t("sales",'CREATE_QUOTES');
endif;

$this->hiddenpath = '/sales/quote/create';
?>
</h1>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'quote-form',
	'enableAjaxValidation'=>false,
)); 
echo $form->errorSummary(array($model,$quote),''); 
//echo '<pre>';print_r($products);
$i = 0;
$total_price = 0;
?>
<table>
<?php
foreach($data as $prod_detail):
    $remark_value = '';
    if(isset($products) && !empty($products)):
	$price_value = $products[$i]->quote_price;
	$remark_value = $products[$i]->remarks;
    endif;
    $price_by_qty = Myclass::getprice_via_qty($prod_detail['prod_id'],$prod_detail['qty']);
    $price_value = $price_by_qty * $prod_detail['qty'];
?>
<!--<div class="row-fluid make_quote">-->
    <?php
    echo '<tr>';
//    echo $prod_detail['name']." ( ".Myclass::GetSiteSetting('AMOUNT_FORMAT'). Myclass::getprice_via_qty($prod_detail['prod_id'],$prod_detail['qty'])." )";
    $max_length = "12";
    echo '<td>';
    echo (strlen($prod_detail['name']) > $max_length) ? substr($prod_detail['name'], 0, $max_length)."..." : $prod_detail['name'];
    echo '</td>';
    echo '<td>'.$form->textField($model,"quantity[{$prod_detail['prod_id']}]",array('class'=>'input-mini','value'=>$prod_detail['qty'],'readonly'=>'readonly')).'</td>';
    echo '<td>'.$form->textField($model,"quote_price[{$prod_detail['prod_id']}]",array('placeholder'=>'Expected Quote Price','class'=>'input-mini','value'=>$price_by_qty,'onkeypress'=>'return isNumberKey(event)','readonly'=>'readonly')).'</td>';
    echo '<td>'.$form->textField($model,"total_price[{$prod_detail['prod_id']}]",array('class'=>'input-mini','value'=>$price_value,'readonly'=>'readonly')).'</td>';
    echo '<td>'.$form->textField($model,"remarks[{$prod_detail['prod_id']}]",array('placeholder'=>'Remarks','class'=>'remarks','value'=>$remark_value)).'</td>';
    $total_price += $price_value;
    echo '</tr>';
    ?>
<!--</div>	-->
<?php $i++; endforeach; ?>
</table>
<?php echo '<div class="pull-left">'.Myclass::t('Total price').' :'.Myclass::GetSiteSetting('AMOUNT_FORMAT').$total_price.'</div>';    ?>    
    <div class="make_quote_button">
<?php
echo $form->labelEx($quote,'delivery_date',array('class'=>'ex_del'));
$this->getDatePicker('delivery_date', $quote,'');
if(@$this->action->id == 'edit')://Edit Mode
//    echo CHtml::submitButton('Modify Quote Request',array('class'=>'quote_sub'));
    $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>Myclass::t('Modify Quote')));
    echo CHtml::link("<i class='icon-remove'></i>cancel",array('/sales/quote/view','id'=>$quote->quote_id,'ret'=>$ret),array('class'=>'btn clearfix pull-right','style'=>'margin-left:5px;'));
else:    
//    echo CHtml::submitButton('Create Quote Request',array('class'=>'quote_sub'));
    $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>Myclass::t('Create Quote Request')));
endif;
?></div>
    <?PHP
    if(@$this->action->id != 'edit')
        echo CHtml::link(Myclass::t('Add More Products'),array('/sales/quote/create'),array('class'=>'add_more_prdts'));
    ?>
<?php $this->endWidget(); ?>
</div><!-- form -->
<div id="tese" style="display:none;"></div>

