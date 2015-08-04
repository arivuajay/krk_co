<?php 
    $this->menu = array(
		array('label'=>Yii::t('default','Settings')),
		array('label'=>Yii::t('default','Role Setup'),'url'=>array('/settings/role/index')),
		array('label'=>Yii::t('default','Application Setup'),'url'=>array('/settings/sitesettings/index'))		
		);
    $this->menuclass = 'settings';
    $this->menu2 = array(
		    array('label'=>Yii::t('default','Product Settings')),
		    array('label'=>Yii::t('default','Price Range'),'url'=>array('/settings/productprice/index')),
		    array('label'=>Yii::t('default','Product Class'),'url'=>array('/settings/productclass/index')),
//		    array('label'=>'Customer','url'=>array('/settings/customer/index')),
//		    array('label'=>'Vendor','url'=>array('/settings/vendor/index')),
//		    array('label'=>'Shipment','url'=>array('/settings/shipment/index'))
		);
    $this->menu2class = 'products';
?>