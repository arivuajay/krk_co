<?php
/* @var $this PurchaseorderController */
/* @var $model PurchaseOrder */

$this->title='Create Purchase Orders';
$this->breadcrumbs=array(
	'Purchase Orders'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', compact('model', 'detail_model','po_products')); ?>
</div>
