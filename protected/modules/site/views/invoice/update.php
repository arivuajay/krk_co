<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->title='Update Invoices: '. $model->invoice_id;
$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	'Update Invoices',
);
?>

<div class="user-create">
        <?php $this->renderPartial('_form', compact('model', 'detail_model')); ?>
</div>