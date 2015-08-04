<?php 
    $this->menu=array(
		array('label'=>Yii::t('default','Create User'),'icon'=>'menu-title-user','url'=>array('/user/default/create')),
		array('label'=>Yii::t('default','View Users'),'icon'=>'menu-title-view', 'url'=>array('/user/default/index')),
		array('label'=>Yii::t('default','Manage Role Permission'),'icon'=>'menu-title-role', 'url'=>array('/user/default/managerole')),
	    );
?>