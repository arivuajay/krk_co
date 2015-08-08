<?php
/* @var $this ProductvarietyController */
/* @var $model ProductVariety */

$this->breadcrumbs=array(
	'Product Varieties'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProductVariety', 'url'=>array('index')),
	array('label'=>'Create ProductVariety', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-variety-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Product Varieties</h1>

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
	'id'=>'product-variety-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'variety_id',
		'pro_family_id',
		'product_id',
		'variety_name',
		'status',
		'created_by',
		/*
		'created_at',
		'modified_by',
		'modified_at',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
