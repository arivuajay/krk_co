<?php 
    $this->menu=array(
		array('label'=>Yii::t('default','Inbox'),'icon'=>'home','url'=>array('/message/inbox/inbox')),
		array('label'=>Yii::t('default','Sent'),'icon'=>'home','url'=>array('/message/sent/sent')),
		array('label'=>Yii::t('default','Compose'),'icon'=>'home','url'=>array('/message/compose/compose')),		
	    );
?>