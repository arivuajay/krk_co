<?php
/* @var $this OrderdetailController */
/* @var $model Orderdetail */

$this->breadcrumbs=array(
	'Orderdetails'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Orderdetail', 'url'=>array('index')),
	array('label'=>'Manage Orderdetail', 'url'=>array('admin')),
);
?>

<h1>Create Orderdetail</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>