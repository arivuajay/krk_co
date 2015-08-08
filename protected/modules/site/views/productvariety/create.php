<?php
/* @var $this ProductvarietyController */
/* @var $model ProductVariety */

$this->title='Create Product Varieties';
$this->breadcrumbs=array(
	'Product Varieties'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
