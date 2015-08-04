<?php
/* @var $this DefaultController */
/* @var $model Updates */

$this->breadcrumbs=array(
	'Updates'=>array('index'),
	$model->notify_id,
);

$this->menu=array(
	array('label'=>'List Updates', 'url'=>array('index')),
	array('label'=>'Create Updates', 'url'=>array('create')),
	array('label'=>'Update Updates', 'url'=>array('update', 'id'=>$model->notify_id)),
	array('label'=>'Delete Updates', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->notify_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Updates', 'url'=>array('admin')),
);
?>

<h1>View Updates #<?php echo $model->notify_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'notify_id',
		'notify_type',
		'notify_update_id',
		'notify_status',
		'notify_from_user',
		'notify_to_user',
		'notify_on',
		'notify_deleted',
	),
)); ?>
