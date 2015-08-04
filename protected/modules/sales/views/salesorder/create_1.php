<?php
$this->hiddenpath = '/sales/salesorder/create';
//var_dump($this->data);

if(!isset($this->data['soid'])):
echo CHtml::script("$(document).ready(function(){
    $('a[href=\'#yw0_tab_2\']').click(function(){
	alert('".Myclass::t('Please Fill Customer Information First')."');
	return false;
    });
});");

    $tab2_content = Myclass::t('Before Save Your Customer Information');
else:
    $tab2_content = $this->renderPartial('_oform_1',$this->data,true);
endif;

if(!$this->data['soordmodel']->total_order_value):
    echo CHtml::script("$(document).ready(function(){
    $('a[href=\'#yw0_tab_3\']').click(function(){
	alert('".Myclass::t('Please Fill Order Details First')."');
	return false;
    });
    });");
    $tab3_content = Myclass::t('Before Save Your Order Details');
else:
   $tab3_content = $this->renderPartial('_iform_1',$this->data,true);
endif;

switch ($this->data['active_tab']):
    case "tab1" : $title = Myclass::t('Create SO');	break;
    case "tab2" : $title = Myclass::t('Setup Order Details');	break;
    case "tab3" : $title = Myclass::t('Setup Invoice Milestones');	break;
endswitch;

echo "<h1>$title</h1>";
$this->widget('bootstrap.widgets.BootTabbable',array(
    'activeTab'=>$this->data['active_tab'],
    'tabs'=>array(
        'tab1'=>array(
            'label'=>Myclass::t('Customer Information'),
            'content'=>$this->renderPartial('_sform_1',$this->data,true),
        ),
        'tab2'=>array(
            'label'=>Myclass::t('Order Details'),
            'content'=>$tab2_content,
        ),
        'tab3'=>array(
            'label'=>Myclass::t('Invoice Milestones'),
	    'content'=>$tab3_content,
        )
    ),
));


?>

