<?php
/* @var $this UserRoleController */
/* @var $model UserRole */

$this->breadcrumbs=array(
	'User Roles'=>array('index'),
	$model->user_role_id=>array('view','id'=>$model->user_role_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserRole', 'url'=>array('index')),
	array('label'=>'Create UserRole', 'url'=>array('create')),
	array('label'=>'View UserRole', 'url'=>array('view', 'id'=>$model->user_role_id)),
	array('label'=>'Manage UserRole', 'url'=>array('admin')),
);
?>

<h1>Update UserRole <?php echo $model->user_role_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>