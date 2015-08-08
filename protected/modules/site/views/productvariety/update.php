<?php
/* @var $this ProductvarietyController */
/* @var $model ProductVariety */

$this->title='Update Product Varieties: '. $model->variety_id;
$this->breadcrumbs=array(
	'Product Varieties'=>array('index'),
	'Update Product Varieties',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?></div>