<?php
/* @var $this ProductClassController */
/* @var $model ProductClass */

$this->breadcrumbs=array(
	'Product Classes'=>array('index'),
	$model->name=>array('view','id'=>$model->product_class_id),
	'Update',
);

$this->menu=array(
	array('label'=>Myclass::t('List ProductClass'), 'url'=>array('index')),
	array('label'=>Myclass::t('Create ProductClass'), 'url'=>array('create')),
	array('label'=>Myclass::t('View ProductClass'), 'url'=>array('view', 'id'=>$model->product_class_id)),
	array('label'=>Myclass::t('Manage ProductClass'), 'url'=>array('admin')),
);
?>

<h1><?php echo Myclass::t('Update ProductClass');?> <?php echo $model->product_class_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>