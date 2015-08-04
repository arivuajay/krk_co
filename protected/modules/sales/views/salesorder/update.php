<?php
/* @var $this SalesorderController */
/* @var $model Salesorder */

$this->breadcrumbs=array(
	'Salesorders'=>array('index'),
	$model->so_id=>array('view','id'=>$model->so_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Salesorder', 'url'=>array('index')),
	array('label'=>'Create Salesorder', 'url'=>array('create')),
	array('label'=>'View Salesorder', 'url'=>array('view', 'id'=>$model->so_id)),
	array('label'=>'Manage Salesorder', 'url'=>array('admin')),
);
?>

<h1><?php echo Myclass::t('Update Salesorder');?> <?php echo $model->so_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>