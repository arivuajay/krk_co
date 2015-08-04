<?php
/* @var $this UserReportingController */
/* @var $model UserReporting */

$this->breadcrumbs=array(
	'User Reportings'=>array('index'),
	$model->user_reporting_id=>array('view','id'=>$model->user_reporting_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserReporting', 'url'=>array('index')),
	array('label'=>'Create UserReporting', 'url'=>array('create')),
	array('label'=>'View UserReporting', 'url'=>array('view', 'id'=>$model->user_reporting_id)),
	array('label'=>'Manage UserReporting', 'url'=>array('admin')),
);
?>

<h1>Update UserReporting <?php echo $model->user_reporting_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>