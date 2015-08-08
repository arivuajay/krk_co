<?php
/* @var $this VendorController */
/* @var $model Vendor */

$this->breadcrumbs=array(
	'Vendors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Vendor', 'url'=>array('index')),
	array('label'=>'Create Vendor', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#vendor-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Vendors</h1>

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
	'id'=>'vendor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'vendor_id',
		'vendor_type_id',
		'vendor_code',
		'vendor_name',
		'vendor_address',
		'vendor_city',
		/*
		'vendor_country',
		'vendor_contact_person',
		'vendor_mobile_no',
		'vendor_office_no',
		'vendor_email',
		'vendor_website',
		'vendor_trade_mark',
		'vendor_remarks',
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
