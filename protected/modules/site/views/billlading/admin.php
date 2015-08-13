<?php
/* @var $this BillladingController */
/* @var $model BillLading */

$this->breadcrumbs=array(
	'Bill of Lading'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List BillLading', 'url'=>array('index')),
	array('label'=>'Create BillLading', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#bill-lading-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Bill of Lading</h1>

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
	'id'=>'bill-lading-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'bl_id',
		'bl_company_id',
		'bl_vendor_id',
		'bl_po_id',
		'bl_invoice_id',
		'bl_number',
		/*
		'bl_issue_date',
		'bl_issue_place',
		'bl_load_port',
		'bl_discharge_port',
		'bl_vessal_name',
		'bl_shipped_date',
		'bl_container_number',
		'bl_liner_id',
		'bl_container_count',
		'bl_free_days',
		'bl_frieght_paid',
		'bl_documents',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
