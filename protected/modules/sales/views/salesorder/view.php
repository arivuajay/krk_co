<?php
/* @var $this SalesorderController */
/* @var $model Salesorder */

$this->breadcrumbs=array(
	'Salesorders'=>array('index'),
	$model->so_id,
);

$this->menu=array(
	array('label'=>'List Salesorder', 'url'=>array('index')),
	array('label'=>'Create Salesorder', 'url'=>array('create')),
	array('label'=>'Update Salesorder', 'url'=>array('update', 'id'=>$model->so_id)),
	array('label'=>'Delete Salesorder', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->so_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Salesorder', 'url'=>array('admin')),
);
?>

<h1>View Salesorder #<?php echo $model->so_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'so_id',
		'customer_id',
		'customer',
		'primary_contact',
		'so_created_date',
		'quote_approved',
		'phone',
		'ship_address',
		'ship_city',
		'ship_state',
		'same_as_shipping',
		'bill_address',
		'bill_city',
		'bill_state',
		'is_active',
		'is_deleted',
	),
)); ?>
