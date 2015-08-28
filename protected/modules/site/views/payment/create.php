<?php
/* @var $this PaymentController */
/* @var $model Payment */

$this->title='Create Payments';
$this->breadcrumbs=array(
	'Payments'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
