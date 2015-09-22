<?php
/* @var $this PurchaseexpensesController */
/* @var $model PurchaseExpenses */

$this->title='Create Purchase Expenses';
$this->breadcrumbs=array(
	'Purchase Expenses'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
