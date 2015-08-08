<?php
/* @var $this VendorController */
/* @var $model Vendor */

$this->title='Update Vendors: '. $model->vendor_id;
$this->breadcrumbs=array(
	'Vendors'=>array('index'),
	'Update Vendors',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?></div>