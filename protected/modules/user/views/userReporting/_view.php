<?php
/* @var $this UserReportingController */
/* @var $model UserReporting */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_reporting_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_reporting_id), array('view', 'id'=>$data->user_reporting_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reporting_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->reporting_user_id); ?>
	<br />


</div>