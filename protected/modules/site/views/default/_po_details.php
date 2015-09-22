<?php

$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'htmlOptions' => array('class' => 'table table-striped table-bordered'),
    'attributes' => array(
        'purchase_order_code',
        'po_date',
        array(
            'name' => 'po_company_id',
            'value' => $model->poCompany->company_name
        ),
        array(
            'name' => 'po_vendor_id',
            'value' => $model->poVendor->vendor_name
        ),
        array(
            'name' => 'po_liner_id',
            'value' => $model->poLiner->liner_code
        ),
        'po_remarks',
    ),
));
?>