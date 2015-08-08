<?php
/* @var $this PermitController */
/* @var $model Permit */

$this->title='Update Permits: '. $model->permit_id;
$this->breadcrumbs=array(
	'Permits'=>array('index'),
	'Update Permits',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?></div>