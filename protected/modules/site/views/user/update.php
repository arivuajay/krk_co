<?php
/* @var $this UserController */
/* @var $model User */

$this->title='Update Users: '. $model->user_id;
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Update Users',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?></div>