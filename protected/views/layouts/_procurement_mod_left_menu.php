<?php 
    $this->menu = array(
		array('label'=>Yii::t('default','PO Requests')),
		array('label'=>Yii::t('default','Create PO Requests'),'url'=>array('/procurement/po/create')),
		array('label'=>Yii::t('default','Past PO Requests'),'url'=>array('/procurement/po/past')),
		array('label'=>Yii::t('default','Manual PO"s'),'url'=>array('/procurement/po/manualpo')),
		);
    $this->menuclass = 'products';
 
    $this->menu2 = array(
		array('label'=>Yii::t('default','Vendors')),
		array('label'=>Yii::t('default','Setup Vendor'),'url'=>array('/procurement/vendor/create')),	
		array('label'=>Yii::t('default','Vendor List'), 'url'=>array('/procurement/vendor/index')),
		);
    $this->menu2class = 'items';