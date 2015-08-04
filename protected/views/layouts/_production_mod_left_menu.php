<?php 
    $this->menu = array(
		array('label'=>Yii::t('default','Orders')),
		array('label'=>Yii::t('default','Pick'),'url'=>array('/production/pick/index')),
		array('label'=>Yii::t('default','Pack'),'url'=>array('/production/pack/index')),
		array('label'=>Yii::t('default','Ship'),'url'=>array('/production/ship/index')),
		);
    $this->menuclass = 'orders';
?>