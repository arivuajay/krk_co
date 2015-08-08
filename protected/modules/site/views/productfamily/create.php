<?php
/* @var $this ProductfamilyController */
/* @var $model ProductFamily */

$this->title='Create Product Families';
$this->breadcrumbs=array(
	'Product Families'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
