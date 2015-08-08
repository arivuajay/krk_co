<?php
/* @var $this LinerController */
/* @var $model Liner */

$this->title='Update Liners: '. $model->liner_id;
$this->breadcrumbs=array(
	'Liners'=>array('index'),
	'Update Liners',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?></div>