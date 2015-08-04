<h1>Dashboard</h1>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>  
<?php
//Default Tabs 
$enabled_tabs = array(
	'tab1'=>array(
	    'label'=>Myclass::t('Invoice Statistics'),
	    'content'=>$this->renderPartial('_invoicestat',null,true)
	),
	'tab2'=>array(
	    'label'=>Myclass::t('Sales Statistics'),
	    'content'=>$this->renderPartial('_salestat',null,true)
	),
	'tab3'=>array(
	    'label'=>Myclass::t('Client Statistics'),
	    'content'=>$this->renderPartial('_clientstat',null,true)
	),
	'tab4'=>array(
	    'label'=>Myclass::t('Quotation Statistics'),
	    'content'=>$this->renderPartial('_quotationstat',null,true)
	),
//	'tab5'=>array(
//	    'label'=>'Profile Statistics',
//	    'content'=>$this->renderPartial('_profilestat',null,true)
//	),
);
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');


$this->widget('bootstrap.widgets.BootTabbable',array(
    'activeTab'=>$acttab,
    'tabs'=>$enabled_tabs,
    'htmlOptions'=>array(
        'style'=>'width:auto;'
    )
));
echo CHtml::css('div.tab-content{ overflow:hidden;}');

?>