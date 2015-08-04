<?php
/* @var $this SitesetttingsController */
/* @var $model Sitesettings */

$this->breadcrumbs=array(
	'Sitesettings'=>array('index'),
	$model->settings_id,
);

$this->menu=array(
	array('label'=>Myclass::t('List Sitesettings'), 'url'=>array('index')),
	array('label'=>Myclass::t('Create Sitesettings'), 'url'=>array('create')),
	array('label'=>Myclass::t('Update Sitesettings'), 'url'=>array('update', 'id'=>$model->settings_id)),
	array('label'=>Myclass::t('Delete Sitesettings'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->settings_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Myclass::t('Manage Sitesettings'), 'url'=>array('admin')),
);
?>

<h1>View Sitesettings #<?php echo $model->settings_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'settings_id',
		'key',
		'value',
	),
)); ?>
