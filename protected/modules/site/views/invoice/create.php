<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->title='Create Invoices';
$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', compact('model', 'detail_model','inv_products')); ?>
</div>