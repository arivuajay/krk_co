<?php
/* @var $this ProductPriceRangeController */
/* @var $model ProductPriceRange */

$this->breadcrumbs=array(
	'Product Price Ranges'=>array('index'),
	$model->prid=>array('view','id'=>$model->prid),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductPriceRange', 'url'=>array('index')),
	array('label'=>'Create ProductPriceRange', 'url'=>array('create')),
	array('label'=>'View ProductPriceRange', 'url'=>array('view', 'id'=>$model->prid)),
	array('label'=>'Manage ProductPriceRange', 'url'=>array('admin')),
);
?>

<h1>Update ProductPriceRange <?php echo $model->prid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>