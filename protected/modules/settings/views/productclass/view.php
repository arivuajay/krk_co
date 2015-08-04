<?php
/* @var $this ProductClassController */
/* @var $model ProductClass */

$this->breadcrumbs=array(
	'Product Classes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Myclass::t('List ProductClass'), 'url'=>array('index')),
	array('label'=>Myclass::t('Create ProductClass'), 'url'=>array('create')),
	array('label'=>Myclass::t('Update ProductClass'), 'url'=>array('update', 'id'=>$model->product_class_id)),
	array('label'=>Myclass::t('Delete ProductClass'), 'url'=>'#', 'linkOptions'=>array('submit'=>array(Myclass::t('Delete'),'id'=>$model->product_class_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Myclass::t('Manage ProductClass'), 'url'=>array('admin')),
);
?>

<h1><?php echo Myclass::t('View ProductClass');?> #<?php echo $model->product_class_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'product_class_id',
		'name',
		'created_by',
		'created_date',
		'modified_date',
		'ip_address',
		'is_active',
		'is_deleted',
	),
)); ?>
