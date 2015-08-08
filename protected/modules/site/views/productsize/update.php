<?php
/* @var $this ProductsizeController */
/* @var $model ProductSize */

$this->title='Update Product Sizes: '. $model->size_id;
$this->breadcrumbs=array(
	'Product Sizes'=>array('index'),
	'Update Product Sizes',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?></div>