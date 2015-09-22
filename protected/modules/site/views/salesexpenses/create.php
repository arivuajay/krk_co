<?php
/* @var $this SalesexpensesController */
/* @var $model SalesExpenses */

$this->title='Create Sales Expenses';
$this->breadcrumbs=array(
	'Sales Expenses'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
