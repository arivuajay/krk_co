<?php
/* @var $this BillladingController */
/* @var $model BillLading */

$this->title='Bill of Lading #'.$model->bl_id;
$this->breadcrumbs=array(
	'Bill of Lading'=>array('index'),
	'View '.'BillLading',
);
?>
<div class="user-view">
    <?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'htmlOptions' => array('class'=>'table table-striped table-bordered'),
	'attributes'=>array(
		'blCompany.company_name',
		'blVendor.vendor_name',
		'blPo.purchase_order_code',
		'blInvoice.inv_no',
		'bl_number',
		'bl_issue_date',
		'bl_issue_place',
		'bl_load_port',
		'bl_discharge_port',
		'bl_vessal_name',
		'bl_shipped_date',
		'blLiner.liner_name',
		'bl_container_count',
		'bl_free_days',
            array(
                'name' => 'bl_frieght_paid',
                'value' => $model->bl_frieght_paid == 'Y' ? 'Yes' : 'No'
            ),
            array(
                'name' => 'bl_documents',
                'type' => 'raw',
                'value' => !empty($model->bl_documents) ? CHtml::link('Click to view', $model->getFilePath(false, 'bl_documents'), array('target' => '_blank', 'id' => 'bl_documents', 'class' => 'btn btn-xs btn-primary')) : 'Not set'
            ),
		'bl_remarks',
	),
)); ?>
</div>



