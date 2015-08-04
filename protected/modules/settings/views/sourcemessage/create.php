<?php
/* @var $this SourcemessageController */
/* @var $model Sourcemessage */

$this->breadcrumbs=array(
	'Sourcemessages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Sourcemessage', 'url'=>array('index')),
	array('label'=>'Manage Sourcemessage', 'url'=>array('admin')),
);
?>

<h1>Create Sourcemessage</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'msgmodel'=>$msgmodel)); ?>