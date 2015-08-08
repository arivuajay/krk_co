<?php
/* @var $this ProductfamilyController */
/* @var $model ProductFamily */

$this->title='Update Product Families: '. $model->pro_family_id;
$this->breadcrumbs=array(
	'Product Families'=>array('index'),
	'Update Product Families',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?></div>