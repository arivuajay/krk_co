<?php
/* @var $this UserDepartmentController */
/* @var $model UserDepartment */

$this->breadcrumbs=array(
	'User Departments'=>array('index'),
	$model->user_depart_id,
);

$this->menu=array(
	array('label'=>'List UserDepartment', 'url'=>array('index')),
	array('label'=>'Create UserDepartment', 'url'=>array('create')),
	array('label'=>'Update UserDepartment', 'url'=>array('update', 'id'=>$model->user_depart_id)),
	array('label'=>'Delete UserDepartment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_depart_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserDepartment', 'url'=>array('admin')),
);
?>

<h1>View UserDepartment #<?php echo $model->user_depart_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_depart_id',
		'user_id',
		'department_id',
	),
)); ?>
