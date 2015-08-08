<?php
/* @var $this ProductsizeController */
/* @var $model ProductSize */

$this->title='Create Product Sizes';
$this->breadcrumbs=array(
	'Product Sizes'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
