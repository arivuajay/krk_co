<?php
/* @var $this ExpenseController */
/* @var $model Expense */

$this->title='Create Expenses';
$this->breadcrumbs=array(
	'Expenses'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
