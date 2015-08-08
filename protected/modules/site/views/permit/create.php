<?php
/* @var $this PermitController */
/* @var $model Permit */

$this->title='Create Permits';
$this->breadcrumbs=array(
	'Permits'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
