<?php
$this->hiddenpath = "/procurement/po/past";

//Default Tabs After Creating SO
$enabled_tabs = array(
		'tab1'=>array(
		    'label'=>Myclass::t('PO Information'),
		    'content'=>$this->renderPartial('_summaryview', $this->data,true,false),
		),
		'tab2'=>array(
		    'label'=>Myclass::t('Order Details'),
		    'content'=>$this->renderPartial('_orderview', $this->data,true,false),
		),
		'tab3'=>array(
		    'label'=>Myclass::t('Payment Milestones'),
		    'content'=>$this->renderPartial('_milestoneview', $this->data,true,false),
		),
	);

if($this->data['summary']->po_ord_status >= '2'):
    $enabled_tabs['tab4'] = array(
				'label'=>Myclass::t('Receipts'),
				'content'=>$this->renderPartial('_receiptsview',$this->data,true,false),
			    );
else:
    $enabled_tabs['tab4'] = array(
				'label'=>Myclass::t('Receipts'),
				'targeturl'=>$this->createUrl('/procurement/po/createpo',array('poid'=>$this->data['summary']->po_ord_id,'acttab'=>'tab4')),
			    );
    
endif;

if(isset($this->data['invoices']) && !empty($this->data['invoices'])):
    $enabled_tabs['tab5'] = array(
				'label'=>Myclass::t('Payment Trail'),
				'content'=>$this->renderPartial('_invoice_view', $this->data,true,false),
			    );
endif;

$this->widget('bootstrap.widgets.BootTabbable',array(
    'activeTab'=>'tab1',
    'tabs'=>$enabled_tabs,
    'htmlOptions'=>array(
        'style'=>'width:auto;'
    )
));

?>
