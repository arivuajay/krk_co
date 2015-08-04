<?php
/* @var $this ProductPriceRangeController */
/* @var $model ProductPriceRange */

$this->breadcrumbs=array(
	'Product Price Ranges'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductPriceRange', 'url'=>array('index')),
	array('label'=>'Manage ProductPriceRange', 'url'=>array('admin')),
);
?>

<h1>Create ProductPriceRange</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>