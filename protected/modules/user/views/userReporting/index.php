<?php
/* @var $this UserReportingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Reportings',
);

$this->menu=array(
	array('label'=>'Create UserReporting', 'url'=>array('create')),
	array('label'=>'Manage UserReporting', 'url'=>array('admin')),
);
?>

<h1>User Reportings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
