<?php
/* @var $this PytooriginController */
/* @var $model PytoOrigin */

$this->breadcrumbs=array(
	'Pyto Origins'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PytoOrigin', 'url'=>array('index')),
	array('label'=>'Create PytoOrigin', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pyto-origin-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Pyto Origins</h1>

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
	'id'=>'pyto-origin-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'pyto_id',
		'pyto_company_id',
		'pyto_vendor_id',
		'pyto_po_id',
		'pyto_invoice_id',
		'pyto_cert_no',
		/*
		'doinspection',
		'origin_cert_no',
		'pyto_file',
		'origin_file',
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
