<?php
/* @var $this CompanyController */
/* @var $model Company */

$this->title='Create Companies';
$this->breadcrumbs=array(
	'Companies'=>array('index'),
	$this->title,
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
