<?php
$this->hiddenpath = '/procurement/po/past';
//var_dump($this->data);

if(!isset($this->data['poid'])):
echo CHtml::script("$(document).ready(function(){
    $('a[href=\'#yw0_tab_2\']').click(function(){
	alert('Please Fill Customer Information First');
	return false;
    });
});");

    $tab2_content = Myclass::t('Before Save Your Customer Information');
else:
    $tab2_content = $this->renderPartial('_po_order',$this->data,true);
endif;

if(!$this->data['pomodel']->po_ord_date && !$this->data['pomodel']->po_ship_date):
    echo CHtml::script("$(document).ready(function(){
    $('a[href=\'#yw0_tab_3\']').click(function(){
	alert('Please Fill Order Details First');
	return false;
    });
    });");
    $tab3_content = Myclass::t('Before Save Your Order Details');
else:
    $tab3_content = $this->renderPartial('_po_milestones',$this->data,true);
    $tab4_content = "Before Add Milestones";
//   $tab5_content = $this->renderPartial('_po_payments',$this->data,true);
endif;

if($this->data['poreceiptmodel']):
    $tab4_content = $this->renderPartial('_po_receipts',$this->data,true);    
endif;

switch ($this->data['acttab']):
    case "tab1" : $title = Myclass::t('PO Summary');	break;
    case "tab2" : $title = Myclass::t('Order Details');	break;
    case "tab3" : $title = Myclass::t('Payment Milestones');	break;
    case "tab4" : $title = Myclass::t('Receipts');	break;
    case "tab5" : $title = Myclass::t('Payments');	break;
endswitch;


//Default Tabs After Creating SO
$enabled_tabs = array(
		'tab1'=>array(
		    'label'=>Myclass::t('PO Summary'),
		    'content'=>$this->renderPartial('_po_summary',$this->data,true),
		),
		'tab2'=>array(
		    'label'=>Myclass::t('Order Details'),
		    'content'=>$tab2_content,
		),
		'tab3'=>array(
		    'label'=>Myclass::t('Payment Milestones'),
		    'content'=>$tab3_content,
		),
		'tab4'=>array(
		    'label'=>Myclass::t('Receipts'),
		    'content'=>$tab4_content,
		)
	);

if(isset($this->data['invoices']) && !empty($this->data['invoices'])):
    $enabled_tabs['tab5'] = array(
				'label'=>Myclass::t('Payment Trail'),
				'content'=>$this->renderPartial('_invoice_view', $this->data,true,false),
			    );
endif;

echo "<h1>$title</h1>";
$this->widget('bootstrap.widgets.BootTabbable',array(
    'activeTab'=>$this->data['acttab'],
    'tabs'=>$enabled_tabs
));


?>

