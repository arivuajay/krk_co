<?php
/* @var $this AccessController */
/* @var $model Access */

$this->breadcrumbs=array(
	'Accesses'=>array('index'),
	$model->access_id,
);

$this->menu=array(
	array('label'=>'List Access', 'url'=>array('index')),
	array('label'=>'Create Access', 'url'=>array('create')),
	array('label'=>'Update Access', 'url'=>array('update', 'id'=>$model->access_id)),
	array('label'=>'Delete Access', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->access_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Access', 'url'=>array('admin')),
);
?>

<h1>View Access #<?php echo $model->access_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'access_id',
		'access_name',
		'access_path',
		'created_by',
		'created_date',
		'modified_date',
		'is_active',
		'is_deleted',
		'orderid',
	),
)); ?>
