<?php
/* @var $this ExpensesController */
/* @var $model Expenses */

$this->title='Create Expenses';
$this->breadcrumbs=array(
	'Expenses'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
