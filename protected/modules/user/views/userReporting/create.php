<?php
/* @var $this UserReportingController */
/* @var $model UserReporting */

$this->breadcrumbs=array(
	'User Reportings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserReporting', 'url'=>array('index')),
	array('label'=>'Manage UserReporting', 'url'=>array('admin')),
);
?>

<h1>Create UserReporting</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>