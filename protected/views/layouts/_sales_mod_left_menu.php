<?php 
    $this->menu = array(
		array('label'=>Yii::t('default','Company')),
		array('label'=>Yii::t('default','Create Company'),'url'=>array('/sales/default/createcompany')),
		array('label'=>Yii::t('default','View Companies'),'url'=>array('/sales/default/viewcompanies')),
		);
    $this->menuclass = 'company';
    $this->menu2 = array(
		array('label'=>Yii::t('default','Quotes')),
		array('label'=>Yii::t('default','Create Quote'),'url'=>array('/sales/quote/create')),
		array('label'=>Yii::t('default','My Quotes'),'url'=>array('/sales/quote/myquotes')),
		);
    $this->menu2class = 'quotes';
    $this->menu3 = array(
		array('label'=>Yii::t('default','Create SO'),'url'=>array('/sales/salesorder/create')),
		array('label'=>Yii::t('default','My SO'),'url'=>array('/sales/salesorder/view')),
		);
    $this->menu3class = 'sales_order';
    $this->menu4 = array(
		array('label'=>Yii::t('default','Sample Request')),
		array('label'=>Yii::t('default','Create Sample Request'),'url'=>array('/sales/sample/create')),
		array('label'=>Yii::t('default','My Sample Request'),'url'=>array('/sales/sample/view')),
		);
    $this->menu4class = 'sales_order';
?>