<?php
/* @var $this UserController */
/* @var $model User */

$this->title='Create Users';
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
