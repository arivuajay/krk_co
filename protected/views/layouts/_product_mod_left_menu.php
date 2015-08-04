<?php 
    $this->menu = array(
		array('label'=>Yii::t('default','Products')),
		array('label'=>Yii::t('default','Add Product'),'url'=>array('/products/product/create')),
		array('label'=>Yii::t('default','View Product'),'url'=>array('/products/product/view')),	
		array('label'=>Yii::t('default','Product Category'), 'url'=>array('/products/category/index')),
		array('label'=>Yii::t('default','Add Category'), 'url'=>array('/products/category/create')),		
		array('label'=>Yii::t('default','Import'), 'url'=>Yii::app()->createUrl('/importcsv/default/index')),
		);
    $this->menuclass = 'products';
    $this->menu2 = array(
		array('label'=>Yii::t('default','Items')),
		array('label'=>Yii::t('default','View Items'),'url'=>array('/products/items/index')),	
		array('label'=>Yii::t('default','Add Items'), 'url'=>array('/products/items/create')),
		);
    $this->menu2class = 'items';
?>