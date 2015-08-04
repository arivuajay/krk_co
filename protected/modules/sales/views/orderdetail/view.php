<?php
/* @var $this OrderdetailController */
/* @var $model Orderdetail */

$this->breadcrumbs=array(
	'Orderdetails'=>array('index'),
	$model->od_id,
);

$this->menu=array(
	array('label'=>'List Orderdetail', 'url'=>array('index')),
	array('label'=>'Create Orderdetail', 'url'=>array('create')),
	array('label'=>'Update Orderdetail', 'url'=>array('update', 'id'=>$model->od_id)),
	array('label'=>'Delete Orderdetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->od_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Orderdetail', 'url'=>array('admin')),
);
?>

<h1>View Orderdetail #<?php echo $model->od_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'od_id',
		'order_date',
		'shipment_date',
		'product_name',
		'quantity',
		'unit_price',
		'order_value',
		'total_order_value',
	),
)); ?>
