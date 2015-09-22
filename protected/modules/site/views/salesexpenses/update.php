<?php
/* @var $this SalesexpensesController */
/* @var $model SalesExpenses */

$this->title='Update Sales Expenses: '. $model->sale_exp_id;
$this->breadcrumbs=array(
	'Sales Expenses'=>array('index'),
	'Update Sales Expenses',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?></div>