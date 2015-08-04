<?php 
    $this->menu = array(
		array('label'=>Yii::t('default','Invoices')),
		array('label'=>Yii::t('default','New Invoices'),'url'=>array('/finance/invoice/index')),
		array('label'=>Yii::t('default','InDue Invoices'),'url'=>array('/finance/invoice/past')),
		array('label'=>Yii::t('default','Paid Invoices'),'url'=>array('/finance/invoice/paid')),	
		);
    $this->menuclass = 'products';
    
   $this->menu2 = array(
		array('label'=>Yii::t('default','Memo')),
		array('label'=>Yii::t('default','Credit memo'),'url'=>array('/finance/memo/credit')),
		array('label'=>Yii::t('default','Debit memo'),'url'=>array('/finance/memo/debit')),
		array('label'=>Yii::t('default','Past memo'),'url'=>array('/finance/memo/past')),
		);
    $this->menu2class = 'products';
    
    $this->menu3 = array(
		array('label'=>Yii::t('default','Payments')),
		array('label'=>Yii::t('default','Indue PO"s'),'url'=>array('/finance/invoice/induepayments')),
		array('label'=>Yii::t('default','Paid PO"s'),'url'=>array('/finance/invoice/pastpayments')),
		);
    $this->menu3class = 'products';
    
    $this->menu4 = array(array('label'=>Yii::t('default','Account Summary'),'url'=>array('/finance/invoice/accountsummary')));
    $this->menu4class = 'account_summary';