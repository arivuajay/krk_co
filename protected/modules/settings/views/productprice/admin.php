<?php
/* @var $this ProductPriceRangeController */
/* @var $model ProductPriceRange */

$this->breadcrumbs=array(
	'Product Price Ranges'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProductPriceRange', 'url'=>array('index')),
	array('label'=>'Create ProductPriceRange', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-price-range-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Product Price Ranges</h1>

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
	'id'=>'product-price-range-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'prid',
		'range_from',
		'range_to',
		'created_by',
		'modified_by',
		'is_active',
		/*
		'is_deleted',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
