<?php
/* @var $this PermitController */
/* @var $model Permit */

$this->breadcrumbs=array(
	'Permits'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Permit', 'url'=>array('index')),
	array('label'=>'Create Permit', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#permit-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Permits</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'permit-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'permit_id',
		'company_id',
		'permit_no',
		'doissue',
		'valupto',
		'permit_regno',
		/*
		'permit_poissue',
		'permit_file',
		'status',
		'created_at',
		'created_by',
		'modified_at',
		'modified_by',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
