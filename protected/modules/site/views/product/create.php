<?php
/* @var $this ProductController */
/* @var $model Product */

$this->title='Create Products';
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
