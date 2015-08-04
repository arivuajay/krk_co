<?php 
$active_contacts = ($this->action->id=='updatecontact' || $this->action->id == 'addcontact')?true:false;
$active_quotes = ($this->action->id=='companyquote')?true:false;
$active_sos = ($this->action->id=='companyso')?true:false;
$active_inv = ($this->action->id=='companyinv')?true:false;

$this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>Yii::t('default','Profile'),'url'=>array('/sales/default/updatecompany','id'=>$model->company_id)),
        array('label'=>Yii::t('default','Contacts'),'url'=>array('/sales/default/addcontact','id'=>$model->company_id),'active'=>$active_contacts),
	array('label'=>Yii::t('default','Quotes'), 'url'=>array('/sales/default/companyquote','id'=>$model->company_id),'active'=>$active_quotes),
	array('label'=>Yii::t('default','Orders'), 'url'=>array('/sales/default/companyso','id'=>$model->company_id),'active'=>$active_sos),
	array('label'=>Yii::t('default','Invoices'),'url'=>array('/sales/default/companyinv','id'=>$model->company_id),'active'=>$active_inv),
    ),
)); 
?>