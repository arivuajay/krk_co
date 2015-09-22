<?php
/* @var $this ExpenseController */
/* @var $model Expense */

$this->title='Update Expenses: '. $model->exp_id;
$this->breadcrumbs=array(
	'Expenses'=>array('index'),
	'Update Expenses',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?></div>