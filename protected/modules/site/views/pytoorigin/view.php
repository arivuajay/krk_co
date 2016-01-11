<?php
/* @var $this PytooriginController */
/* @var $model PytoOrigin */

$this->title = 'View #' . $model->pyto_id;
$this->breadcrumbs = array(
    'Pyto Origins' => array('index'),
    'View ' . 'PytoOrigin',
);
?>
<div class="user-view">
    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'htmlOptions' => array('class' => 'table table-striped table-bordered'),
        'attributes' => array(
            'pyto_id',
            'pytoCompany.company_name',
            'pytoVendor.vendor_name',
            'pyto_po_id',
            'pyto_invoice_id',
            'pyto_cert_no',
            'doinspection',
            'origin_cert_no',
            array(
                'name' => 'pyto_file',
                'type' => 'raw',
                'value' => !empty($model->pyto_file) ? $model->fileview : 'Not set'
            ),
            array(
                'name' => 'origin_file',
                'type' => 'raw',
                'value' => !empty($model->origin_file) ? $model->fileview1 : 'Not set'
            ),
        ),
    ));
    ?>
</div>



