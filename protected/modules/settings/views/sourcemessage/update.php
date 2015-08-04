<?php
/* @var $this SourcemessageController */
/* @var $model Sourcemessage */

$this->breadcrumbs=array(
	'Sourcemessages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sourcemessage', 'url'=>array('index')),
	array('label'=>'Create Sourcemessage', 'url'=>array('create')),
	array('label'=>'View Sourcemessage', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Sourcemessage', 'url'=>array('admin')),
);
?>

<h1>Update Sourcemessage <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'msgmodel'=>$msgmodel)); ?>