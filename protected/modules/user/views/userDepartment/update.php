<?php
/* @var $this UserDepartmentController */
/* @var $model UserDepartment */

$this->breadcrumbs=array(
	'User Departments'=>array('index'),
	$model->user_depart_id=>array('view','id'=>$model->user_depart_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserDepartment', 'url'=>array('index')),
	array('label'=>'Create UserDepartment', 'url'=>array('create')),
	array('label'=>'View UserDepartment', 'url'=>array('view', 'id'=>$model->user_depart_id)),
	array('label'=>'Manage UserDepartment', 'url'=>array('admin')),
);
?>

<h1>Update UserDepartment <?php echo $model->user_depart_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>