<?php
/* @var $this SalesorderController */
/* @var $model Salesorder */

$this->breadcrumbs=array(
	'Salesorders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Salesorder', 'url'=>array('index')),
	array('label'=>'Create Salesorder', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('salesorder-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Salesorders</h1>

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
	'id'=>'salesorder-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'so_id',
		'customer_id',
		'customer',
		'primary_contact',
		'so_created_date',
		/*
		'quote_approved',
		'phone',
		'ship_address',
		'ship_city',
		'ship_state',
		'same_as_shipping',
		'bill_address',
		'bill_city',
		'bill_state',
		'is_active',
		'is_deleted',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
