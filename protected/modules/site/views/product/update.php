<?php
/* @var $this ProductController */
/* @var $model Product */

$this->title='Update Products: '. $model->product_id;
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Update Products',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?></div>