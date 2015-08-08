<?php
/* @var $this LinerController */
/* @var $model Liner */

$this->title='Create Liners';
$this->breadcrumbs=array(
	'Liners'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
