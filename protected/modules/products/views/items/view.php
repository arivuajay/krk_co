<h1>View Items #<?php echo $model->item_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'item_id',
		'item_code',
		'name',
		'unit_measure_id',
		'reorder_limit',
		'description',
		'imported',
		'created_by',
		'created_date',
		'modified_date',
		'ip_address',
		'is_active',
		'is_deleted',
	),
)); ?>
