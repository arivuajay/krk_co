<?php
/* @var $this PaymentController */
/* @var $model Payment */

$this->title='Update Payments: '. $model->pay_id;
$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'Update Payments',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?></div>