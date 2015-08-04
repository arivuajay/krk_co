<?php
/* @var $this SourcemessageController */
/* @var $model Sourcemessage */

$this->breadcrumbs=array(
	'Sourcemessages'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Sourcemessage', 'url'=>array('index')),
	array('label'=>'Create Sourcemessage', 'url'=>array('create')),
	array('label'=>'Update Sourcemessage', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Sourcemessage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sourcemessage', 'url'=>array('admin')),
);
?>

<h1>View Sourcemessage #<?php echo $model->id; ?></h1>

<?php 
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category',
		'message',
		array(               // related city displayed as a link
		    'label'=>'Messages',
		    'type'=>'raw',
		    'value'=>implode('<br />',CHtml::listData($model->messages,'id','translation')),
		    ),
	),
)); ?>
