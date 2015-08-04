<?php 
$updatecount = Updates::model()->active()->newupdatescount()->count();
$new_count = ($updatecount > 0) ? "<span class='new_counts'>".$updatecount."</span>" : '';

$this->menu=array(
	    array('label'=>Yii::t('default','My Dashboard'),'icon'=>'home','url'=>array('/home/default/index')),
	);
$this->menuclass = 'account_summary';

$this->menu2=array(
	    array('label'=>Yii::t('default','Inbox'),'icon'=>'envelope','url'=>array('/message/inbox/inbox')),
	);
$this->menu2class = 'account_summary';

$this->menu3=array(
	    array('label'=>Yii::t('default','My Tasks'),'icon'=>'edit','url'=>array('/home/default/tasks')),
	);
$this->menu3class = 'account_summary';
$this->menu4=array(
	    array('label'=>$new_count.Yii::t('default','My Txn Updates'),'icon'=>'comment','url'=>array('/home/default/updates')),
	);
$this->menu4class = 'account_summary';
?>