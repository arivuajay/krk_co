<?php
/* @var $this PurchaseorderController */
/* @var $model PurchaseOrder */

$this->title = 'Update Purchase Orders: ' . $model->po_id;
$this->breadcrumbs = array(
    'Purchase Orders' => array('index'),
    'Update Purchase Orders',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', compact('model', 'detail_model','po_products')); ?>
</div>
