<?php
/* @var $this PurchaseexpensesController */
/* @var $model PurchaseExpenses */

$this->title='Update Purchase Expenses: '. $model->pur_exp_id;
$this->breadcrumbs=array(
	'Purchase Expenses'=>array('index'),
	'Update Purchase Expenses',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?></div>