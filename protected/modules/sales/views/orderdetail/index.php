<?php
/* @var $this OrderdetailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Orderdetails',
);

$this->menu=array(
	array('label'=>'Create Orderdetail', 'url'=>array('create')),
	array('label'=>'Manage Orderdetail', 'url'=>array('admin')),
);
?>

<h1>Orderdetails</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
