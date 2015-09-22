<?php
/* @var $this SalesexpensesController */
/* @var $model SalesExpenses */

$this->breadcrumbs=array(
	'Sales Expenses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SalesExpenses', 'url'=>array('index')),
	array('label'=>'Create SalesExpenses', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sales-expenses-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Sales Expenses</h1>

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
	'id'=>'sales-expenses-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'sale_exp_id',
		'product_id',
		'sale_exp_date',
		'sale_exp_amount',
		'sale_exp_remarks',
		'sales_exp_cust_name',
		/*
		'sales_exp_address',
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
