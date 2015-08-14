<?php
/* @var $this PytooriginController */
/* @var $model PytoOrigin */

$this->title='Pyto & Origin Certificate';
$this->breadcrumbs=array(
	'Pyto Origins'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
