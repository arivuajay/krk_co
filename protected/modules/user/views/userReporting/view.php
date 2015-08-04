<?php
/* @var $this UserReportingController */
/* @var $model UserReporting */

$this->breadcrumbs=array(
	'User Reportings'=>array('index'),
	$model->user_reporting_id,
);

$this->menu=array(
	array('label'=>'List UserReporting', 'url'=>array('index')),
	array('label'=>'Create UserReporting', 'url'=>array('create')),
	array('label'=>'Update UserReporting', 'url'=>array('update', 'id'=>$model->user_reporting_id)),
	array('label'=>'Delete UserReporting', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_reporting_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserReporting', 'url'=>array('admin')),
);
?>

<h1>View UserReporting #<?php echo $model->user_reporting_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_reporting_id',
		'user_id',
		'reporting_user_id',
	),
)); ?>
