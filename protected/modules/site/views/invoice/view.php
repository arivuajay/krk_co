<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->title = 'Invoice #' . $model->inv_no;
$this->breadcrumbs = array(
    'Invoices' => array('index'),
    'View Invoice',
);
?>
<div class="user-view">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'htmlOptions' => array('class' => 'table table-striped table-bordered'),
        'attributes' => array(
            'inv_no',
            'inv_date',
            array(
                'name' => 'vendor_id',
                'value' => $model->vendor->vendor_name
            ),
            array(
                'name' => 'company_id',
                'value' => $model->company->company_name
            ),
            array(
                'name' => 'po_id',
                'value' => $model->po->purchase_order_code
            ),
            'permit_no',
            'bol_no',
            'vessel_name',
            array(
                'name' => 'inv_file',
                'type' => 'raw',
                'value' => !empty($model->inv_file) ? CHtml::link('Click to view', $model->getFilePath(false, 'inv_file'), array('target' => '_blank', 'id' => 'inv_file')) : 'Not set'
            ),
            array(
                'name' => 'pkg_list_file',
                'type' => 'raw',
                'value' => !empty($model->pkg_list_file) ? CHtml::link('Click to view', $model->getFilePath(false, 'pkg_list_file'), array('target' => '_blank', 'id' => 'pkg_list_file')) : 'Not set'
            ),
            'inv_remarks',
        ),
    ));

    echo "<h3>Invoice Items:</h3>";
    $inv_products = array();
    foreach ($model->invoiceItems as $item)
                $inv_products[] = CJSON::encode($item->attributes);
    $this->renderPartial('_inv_added_products', compact('inv_products'));
    ?>
</div>



