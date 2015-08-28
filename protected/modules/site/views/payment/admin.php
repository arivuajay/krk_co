<?php
/* @var $this PaymentController */
/* @var $model Payment */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Payment', 'url'=>array('index')),
	array('label'=>'Create Payment', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#payment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Payments</h1>

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
	'id'=>'payment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'pay_id',
		'vendor_id',
		'pay_type',
		'po_id',
		'invoice_id',
		'invoice_amount',
		/*
		'pay_amount',
		'pay_deal_id',
		'pay_inr_rate',
		'pay_date',
		'pay_inr_amount',
		'pay_mode',
		'pay_ref_info',
		'pay_transaction_id',
		'pay_bank_name',
		'pay_remarks',
		'pay_shift_advise',
		'pay_debit_advise',
		'pay_other_doc',
		'pay_deal_id_copy',
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
