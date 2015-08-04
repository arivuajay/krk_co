<?php
/* @var $this UserDepartmentController */
/* @var $model UserDepartment */

$this->breadcrumbs=array(
	'User Departments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserDepartment', 'url'=>array('index')),
	array('label'=>'Manage UserDepartment', 'url'=>array('admin')),
);
?>

<h1>Create UserDepartment</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>