<?php
/* @var $this DefaultController */
/* @var $model Updates */

$this->breadcrumbs=array(
	'Updates'=>array('index'),
	$model->notify_id=>array('view','id'=>$model->notify_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Updates', 'url'=>array('index')),
	array('label'=>'Create Updates', 'url'=>array('create')),
	array('label'=>'View Updates', 'url'=>array('view', 'id'=>$model->notify_id)),
	array('label'=>'Manage Updates', 'url'=>array('admin')),
);
?>

<h1>Update Updates <?php echo $model->notify_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>