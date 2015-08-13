<?php
/* @var $this BillladingController */
/* @var $model BillLading */

$this->title='Create Bill of Lading';
$this->breadcrumbs=array(
	'Bill of Lading'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
