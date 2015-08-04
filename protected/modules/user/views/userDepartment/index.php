<?php
/* @var $this UserDepartmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Departments',
);

$this->menu=array(
	array('label'=>'Create UserDepartment', 'url'=>array('create')),
	array('label'=>'Manage UserDepartment', 'url'=>array('admin')),
);
?>

<h1>User Departments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
