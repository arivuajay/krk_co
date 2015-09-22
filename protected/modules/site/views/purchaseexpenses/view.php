<?php
/* @var $this PurchaseexpensesController */
/* @var $model PurchaseExpenses */

$this->title='View #'.$model->pur_exp_id;
$this->breadcrumbs=array(
	'Purchase Expenses'=>array('index'),
	'View '.'PurchaseExpenses',
);
?>
<div class="user-view">
    <?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'htmlOptions' => array('class'=>'table table-striped table-bordered'),
	'attributes'=>array(
            array(
                'name' => 'po_id',
                'value' => $model->po->purchase_order_code
            ),
		'pur_exp_date',
		'pur_exp_amount',
		'pur_exp_remarks',
	),
)); ?>
</div>



