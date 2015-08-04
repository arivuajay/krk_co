<?php
/* @var $this ProductClassController */
/* @var $model ProductClass */

$this->breadcrumbs=array(
	'Product Classes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Myclass::t('List ProductClass'), 'url'=>array('index')),
	array('label'=>Myclass::t('Manage ProductClass'), 'url'=>array('admin')),
);
?>

<h1><?php echo Myclass::t('Create ProductClass');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>