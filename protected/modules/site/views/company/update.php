<?php
/* @var $this CompanyController */
/* @var $model Company */

$this->title='Update Companies: '. $model->company_id;
$this->breadcrumbs=array(
	'Companies'=>array('index'),
	'Update Companies',
);
?>

<div class="user-create">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?></div>