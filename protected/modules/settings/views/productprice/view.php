<?php
/* @var $this ProductPriceRangeController */
/* @var $model ProductPriceRange */

$this->breadcrumbs=array(
	'Product Price Ranges'=>array('index'),
	$model->prid,
);

$this->menu=array(
	array('label'=>'List ProductPriceRange', 'url'=>array('index')),
	array('label'=>'Create ProductPriceRange', 'url'=>array('create')),
	array('label'=>'Update ProductPriceRange', 'url'=>array('update', 'id'=>$model->prid)),
	array('label'=>'Delete ProductPriceRange', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->prid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductPriceRange', 'url'=>array('admin')),
);
?>

<h1>View ProductPriceRange #<?php echo $model->prid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'prid',
		'range_from',
		'range_to',
		'created_by',
		'modified_by',
		'is_active',
		'is_deleted',
	),
)); ?>
