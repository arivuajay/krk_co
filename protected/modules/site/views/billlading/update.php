<?php
/* @var $this BillladingController */
/* @var $model BillLading */

$this->title='Update Bill of Lading: '. $model->bl_id;
$this->breadcrumbs=array(
	'Bill of Lading'=>array('index'),
	'Update Bill of Lading',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?></div>