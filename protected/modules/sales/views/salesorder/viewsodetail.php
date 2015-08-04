<?php
$this->hiddenpath = "/sales/salesorder/view";

$so_id = $soCdetail->so_id;

//Default Tabs After Creating SO
$enabled_tabs = array(
		'tab1'=>array(
		    'label'=>Myclass::t('Customer Information'),
		    'content'=>$this->renderPartial('_sformview', array('soCdetail'=>$soCdetail),true,false),
		),
		'tab2'=>array(
		    'label'=>Myclass::t('Order Details'),
		    'content'=>$this->renderPartial('_oformview', array('soOdetail'=>$soOdetail,'soPdetail'=>$soPdetail),true,false),
		),
		'tab3'=>array(
		    'label'=>Myclass::t('Invoice Milestones'),
		    'content'=>$this->renderPartial('_iformview', array('soMdetail'=>$soMdetail),true,false),
		)
	);

//Pick Tabs After Pick Released
if($soCdetail->so_status > 1):
    $pickdet = Pick::model()->findAll('salesord_id ='.$so_id);
    $enabled_tabs['tab4'] = array(
				'label'=>Myclass::t('Pick'),
				'content'=>$this->renderPartial('_pickview', array('pickDetail'=>$picks,'pickdet'=>$pickdet),true,false),
			    );
endif;
//Pack Tabs After Pick Released
if($soCdetail->so_status > 2):  
    $packdet = Pack::model()->findAll('salesord_id ='.$so_id);
    $enabled_tabs['tab5'] = array(
				'label'=>Myclass::t('Pack'),
				'content'=>$this->renderPartial('_packview', array('packDetail'=>$picks,'packdet'=>$packdet),true,false),
			    );
endif;
//Ship Tabs After Pick Released
if($soCdetail->so_status > 3):  
    $shipdet = Ship::model()->findAll('salesord_id ='.$so_id);
    $enabled_tabs['tab6'] = array(
				'label'=>Myclass::t('Ship'),
				'content'=>$this->renderPartial('_shipview', array('shipDetail'=>$picks,'shipdet'=>$shipdet),true,false),
			    );
endif;




//Pick Tabs Who Assigned Manager
if($soCdetail->so_status == 1 && $soCdetail->assigned == Yii::app()->user->id):
    $enabled_tabs['tab4'] = array(
				'label'=>Myclass::t('Pick'),
				'targeturl'=>$this->createUrl('/production/pick/view',array('id'=>$so_id)),
			    );
endif;
//Pack Tabs Who Assigned Manager
if($soCdetail->so_status == 2 && $soCdetail->pack_assigned == Yii::app()->user->id):
    $enabled_tabs['tab5'] = array(
				'label'=>Myclass::t('Pack'),
				'targeturl'=>$this->createUrl('/production/pack/view',array('id'=>$so_id)),
			    );
endif;
//ship Tabs Who Assigned Manager
if($soCdetail->so_status == 3 && $soCdetail->ship_assigned == Yii::app()->user->id):
    $enabled_tabs['tab6'] = array(
				'label'=>Myclass::t('Ship'),
				'targeturl'=>$this->createUrl('/production/ship/view',array('id'=>$so_id)),
			    );
endif;


if(isset($invoices) && !empty($invoices)):
    $enabled_tabs['tab7'] = array(
				'label'=>Myclass::t('Payment Trail'),
				'content'=>$this->renderPartial('_invoice_view', array('soOdetail'=>$soOdetail,'invoices'=>$invoices),true,false),
			    );
endif;


//Invoice Tab After
//if($soCdetail->so_status > 4):  
//    $invoices = Invoice::model()->paid()->findAll('inv_so_id ='.$so_id);
//    $enabled_tabs['tab6'] = array(
//				'label'=>'Invoices',
//				'content'=>$this->renderPartial('_invoice_view', array('soOdetail'=>$soOdetail,'invoices'=>$invoices),true,false),
//			    );
//endif;

//var_dump($enabled_tabs);


$this->widget('bootstrap.widgets.BootTabbable',array(
    'activeTab'=>'tab1',
    'tabs'=>$enabled_tabs,
    'htmlOptions'=>array(
        'style'=>'width:auto;'
    )
));

?>
