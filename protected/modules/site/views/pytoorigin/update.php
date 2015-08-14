<?php
/* @var $this PytooriginController */
/* @var $model PytoOrigin */

$this->title='Update Pyto Origins: '. $model->pyto_id;
$this->breadcrumbs=array(
	'Pyto Origins'=>array('index'),
	'Update Pyto Origins',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?></div>