<?php
/* @var $this SourcemessageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sourcemessages',
);

$this->menu=array(
	array('label'=>'Create Sourcemessage', 'url'=>array('create')),
	array('label'=>'Manage Sourcemessage', 'url'=>array('admin')),
);
?>

<h1>Sourcemessages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
