<?php
/* @var $this VendorController */
/* @var $model Vendor */

$this->title='Create Vendors';
$this->breadcrumbs=array(
	'Vendors'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
