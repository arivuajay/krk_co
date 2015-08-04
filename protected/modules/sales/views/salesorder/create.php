<?php
$this->hiddenpath = '/sales/salesorder/create';

$this->widget('bootstrap.widgets.BootTabbable',array(
    'activeTab'=>$active_tab,
    'tabs'=>array(
        'tab1'=>array(
            'label'=>'Customer Information',
            'content'=>$this->renderPartial('_sform', array('smodel'=>$smodel, 'company'=>$company),true,false),
        ),
        'tab2'=>array(
            'label'=>'Order Details',
            'content'=>$this->renderPartial('_oform', array('omodel'=>$omodel,'QuoteProduct'=>$QuoteProduct),true,false),
        ),
        'tab3'=>array(
            'label'=>'Invoice Milestones',
            'content'=>$this->renderPartial('_iform', array('imodel'=>$imodel,'invoice'=>$invoice,'orderValue'=>$orderValue,'salesValue'=>$salesValue,),true,false),
        )
    ),
    'htmlOptions'=>array(
        'style'=>'width:auto;'
    )
));
?>